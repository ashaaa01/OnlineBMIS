<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth; // or use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;
use DOMElement;
use DOMXPath;
use Dompdf\Dompdf;
use Dompdf\Helpers;
use Dompdf\Exception;
use Dompdf\FontMetrics;

/**
 * Import Models here
 */
use App\Models\User;
use App\Models\BarangayResident;
use App\Models\BarangayResidentBlotter;

class BarangayResidentController extends Controller
{
    public function viewBarangayResident(Request $request){
        $barangayResidentDetails = BarangayResident::with('user_info', 'barangay_resident_blotter_details')
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc')
            ->when($request->textFilterZone, function ($query) use ($request) {
                return $query ->where('zone', 'like', '%'.$request->textFilterZone.'%');
            })
            ->when($request->textFilterIdNumber, function ($query) use ($request) {
                return $query ->where('barangay_id_number', 'like', '%'.$request->textFilterIdNumber.'%');
            })
            ->when($request->textFilterAge, function ($query) use ($request) {
                return $query ->where('age', 'like', '%'.$request->textFilterAge.'%');
            })
            ->when($request->dateRangeFrom, function ($query) use ($request) {
                return $query ->where('created_at', '>=', $request->dateRangeFrom);
            })
            ->when($request->dateRangeTo, function ($query) use ($request) {
                return $query ->where('created_at', '<=', $request->dateRangeTo);
            })
            ->get();

            // return $barangayResidentDetails;
        
        if($request->selectFilterGender != null){
            $barangayResidentDetails = collect($barangayResidentDetails)->where('gender',$request->selectFilterGender);
        }
        if($request->selectFilterCivilStatus != null){
            $barangayResidentDetails = collect($barangayResidentDetails)->where('civil_status',$request->selectFilterCivilStatus);
        }
        if($request->selectFilterEducationalAttainment != null){
            $barangayResidentDetails = collect($barangayResidentDetails)->where('educational_attainment',$request->selectFilterEducationalAttainment);
        }
        if ($request->filter_age_category != null) {
            $barangayResidentDetails = $barangayResidentDetails->filter(function ($resident) use ($request) {
                $age = Carbon::parse($resident->birthdate)->age;
                $category = '';
    
                if ($age >= 0 && $age <= 14) {
                    $category = 'Children';
                } elseif ($age >= 15 && $age <= 24) {
                    $category = 'Youth';
                } elseif ($age >= 25 && $age <= 64) {
                    $category = 'Adult';
                } elseif ($age >= 65) {
                    $category = 'Senior';
                }
    
                return $category === $request->filter_age_category;
            });
        }

        // return $barangayResidentDetails;
        return DataTables::of($barangayResidentDetails)
            ->addColumn('status', function($row){
                $result = "";
                if($row->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Active</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Inactive</span></center>';
                }
                return $result;
            })
            ->addColumn('action', function($row){
                if($row->status == 1){
                    $result ='<center>';
                    $result .=   '<button type="button" class="btn btn-info btn-xs text-center actionViewBarangayResident mr-1" barangay-resident-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#modalViewBarangayResident" title="View Details">';
                    $result .=       '<i class="fa fa-xl fa-eye"></i>';
                    $result .=   '</button>';
                    $result .=   '<button type="button" class="btn btn-primary btn-xs text-center actionEditBarangayResident mr-1" barangay-resident-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#modalAddBarangayResident" title="Edit Details">';
                    $result .=       '<i class="fa fa-xl fa-edit"></i>';
                    $result .=   '</button>';
                    // $result .=   '<button type="button" class="btn btn-danger btn-xs text-center actionEditBarangayResidentStatus mr-1" barangay-resident-id="' . $row->id . '" barangay-resident-status="' . $row->status . '" data-bs-toggle="modal" data-bs-target="#modalEditBarangayResidentStatus" title="Disable">';
                    // $result .=       '<i class="fa-solid fa-xl fa-ban"></i>';
                    // $result .=   '</button>';
                    $result .='</center>';
                }
                else{
                    $result =   '<center>
                                <button type="button" class="btn btn-primary btn-xs text-center actionEditBarangayResident mr-1" barangay-resident-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#modalAddBarangayResident" title="Edit Details">
                                    <i class="fa fa-xl fa-edit"></i> 
                                </button>
                                <button type="button" class="btn btn-warning btn-xs text-center actionEditBarangayResidentStatus mr-1" barangay-resident-id="' . $row->id . '" barangay-resident-status="' . $row->status . '" data-bs-toggle="modal" data-bs-target="#modalEditBarangayResidentStatus" title="Enable">
                                    <i class="fa-solid fa-xl fa-arrow-rotate-right"></i>
                                </button>
                            </center>';
                }
                return $result;
            })
            ->addColumn('gender', function($row){
                $result = "";
                if($row->gender == 1){
                    $result .= '<center><span>Male</span></center>';
                }
                else if($row->gender == 2){
                    $result .= '<center><span>Female</span></center>';
                }
                else{
                    $result .= '<center><span>Other</span></center>';
                }
                return $result;
            })
            ->addColumn('civil_status', function($row){
                // 1-Single, 2-Married, 3-Widow/er, 4-Annulled, 5-Legally Separated, 6-Others
                $result = "";
                if($row->civil_status == 1){
                    $result .= '<center><span>Single</span></center>';
                }
                else if($row->civil_status == 2){
                    $result .= '<center><span>Married</span></center>';
                }
                else if($row->civil_status == 3){
                    $result .= '<center><span>Widow/er</span></center>';
                }
                else if($row->civil_status == 4){
                    $result .= '<center><span>Annulled</span></center>';
                }
                else if($row->civil_status == 5){
                    $result .= '<center><span>Legally Separated</span></center>';
                }
                else if($row->civil_status == 6){
                    $result .= '<center><span>Others</span>';
                }
                return $result;
            })
            
             ->addColumn('educational_attainment', function($row){
                 $result = "";
            //     // 1-Elementary Graduate, 2-Elementary Undergraduate, 3-High School Graduate, 4-High School Undergraduate, 5-College Graduate, 6-College Undergraduate, 7-Masters Graduate, 8-Some/Completed Masters Degree, 9-Vocational, 10-Others
                 if($row->educational_attainment == 1){
                     $result .= 'Elementary Graduate';
                 }
                 else if($row->educational_attainment == 2){
                     $result .= 'Elementary Undergraduate';
                 }
                 else if($row->educational_attainment == 3){
                     $result .= 'High School Graduate';
                 }
                 else if($row->educational_attainment == 4){
                     $result .= 'High School Undergraduate';
                 }
                 else if($row->educational_attainment == 5){
                     $result .= 'College Graduate';
                 }
                 else if($row->educational_attainment == 6){
                     $result .= 'College Undergraduate';
                 }
                 else if($row->educational_attainment == 7){
                     $result .= 'Masters Graduate';
                 }
                 else if($row->educational_attainment == 8){
                     $result .= 'Some/Completed Masters Degree';
                 }
                 else if($row->educational_attainment == 9){
                     $result .= 'Vocational';
                 }
                 else if($row->educational_attainment == 10){
                     $result .= 'Others';
                 }
                 return $result;
             })
            ->addColumn('created_at', function($row){
                $result = "";
                $result .= Carbon::parse($row->created_at)->format('M d, Y h:ia');
                return $result;
            })
        ->rawColumns(['status', 'action', 'gender', 'civil_status', 'created_at'])
        ->make(true);
    }

    public function viewBarangayResidentBlotterByResident(Request $request){
        // $barangayResidentBlotterDetails = BarangayResident::with('user_info', 'barangay_resident_blotter_details')
        $barangayResidentBlotterDetails = BarangayResidentBlotter::with('resident_info.user_info')
            ->where('barangay_resident_id', $request->barangayResidentId)
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc')
            ->get();
            // return $barangayResidentBlotterDetails;

        return DataTables::of($barangayResidentBlotterDetails)
            ->addColumn('case_number', function($row){
                $result = "";
                // 
                $result .= '<center><span>'. $row->case_number .'</span></center>';
                return $result;
            })
            ->addColumn('respondent', function($row){
                $result = "";
                // 
                $result .= '<center><span>'. $row->respondent .'</span></center>';
                return $result;
            })
            ->addColumn('complainant', function($row){
                $result = "";
                // 
                $result .= '<center><span>'. ucwords($row->resident_info->user_info->firstname) . ' '. ucwords($row->resident_info->user_info->lastname) .'</span></center>';
                return $result;
            })
            ->addColumn('complainant_statement', function($row){
                $result = "";
                // 
                $result .= '<span>'. $row->complainant_statement .'</span>';
                return $result;
            })
            ->addColumn('reported_date', function($row){
                $result = "";
                // 
                $result .= '<center><span>'. $row->created_at .'</span></center>';
                return $result;
            })
            ->addColumn('action_taken', function($row){
                $result = "";
                // 
                if($row->action_taken == 1){
                    $result .= '<center><span class="badge badge-pill badge-primary">Negotiating</span></center>';
                }
                else if($row->action_taken == 2){
                    $result .= '<center><span class="badge badge-pill badge-success">Both Signed</span></center>';
                }
                else if($row->action_taken == 3){
                    $result .= '<center><span class="badge badge-pill badge-secondary">Others</span></center>';
                }
                return $result;
            })
            ->addColumn('status', function($row){
                $result = "";
                if($row->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-secondary">New</span></center>';
                }
                else if($row->status == 2){
                    $result .= '<center><span class="badge badge-pill badge-primary">On-Going</span></center>';
                }
                else if($row->status == 3){
                    $result .= '<center><span class="badge badge-pill badge-warning">Pending</span></center>';
                }
                else if($row->status == 4){
                    $result .= '<center><span class="badge badge-pill badge-info">Report</span></center>';
                }
                else if($row->status == 5){
                    $result .= '<center><span class="badge badge-pill badge-success">Solved</span></center>';
                }
                else if($row->status == 6){
                    $result .= '<center><span class="badge badge-pill badge-danger">Not Solved</span></center>';
                }
                return $result;
            })
        ->rawColumns(['case_number', 'respondent', 'complainant', 'complainant_statement', 'reported_date', 'reported_date', 'action_taken', 'status'])
        ->make(true);
    }

    public function addBarangayResident(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        
        $data = $request->all();
        /* For Insert */
        if(!isset($request->barangay_resident_id)){
            $validator = Validator::make($data, [
                'user_id' => 'required',
                'gender' => 'required',
                'civil_status' => 'required',
                'birthdate' => 'required|string',
                'age' => 'required|string',
                // 'birth_place' => 'required|string',
                // 'zone' => 'required|string',
                // 'block' => 'required|string',
                // 'lot' => 'required|string',
                // 'street' => 'required|string',
                // 'phase' => 'required|string',
                'nationality' => 'required|string',
                'religion' => 'required|string',
                // 'occupation' => 'required|string',
                // 'monthly_income' => 'required|string',
                // 'phil_health_number' => 'required|string',
                'educational_attainment' => 'required',
                // 'remarks' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
            } else {
                DB::beginTransaction();
                
                $date = date_create("$request->birthdate");
                $birthdate = date_format($date,"Y-m-d");
                try {

                    /**
                     * For uploading image
                     */
                    $image_name = null;
                    if(isset($request->photo)){
                        $image_file = $request->file('photo');
                        $image_name = $image_file->getClientOriginalName();
                        Storage::putFileAs('public/resident_photo', $request->photo, $image_name);
                    }

                    $barangayResidentId = BarangayResident::insertGetId([
                        'gender' => $request->gender,
                        'civil_status' => $request->civil_status,
                        'length_of_stay' => $request->length_of_stay,
                        'birthdate' => $birthdate,
                        'age' => $request->age,
                        'birth_place' => $request->birth_place,
                        'zone' => $request->zone,
                        'barangay' => $request->barangay,
                        'municipality' => $request->municipality,
                        'province' => $request->province,
                       // 'phase' => $request->phase,
                        'nationality' => $request->nationality,
                      //  'block' => $request->block,
                        'religion' => $request->religion,
                        'occupation' => $request->occupation,
                        'monthly_income' => $request->monthly_income,
                        'phil_health_number' => $request->phil_health_number,
                        'educational_attainment' => $request->educational_attainment,
                        'remarks' => $request->remarks,
                        'photo' => $image_name,
                        'user_id' => $request->user_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $_SESSION["session_user_id"],
                        'is_deleted' => 0
                    ]);

                    $barangayIdNumber = "BRGY-PAGASA-" . date("Y") .'-'. $barangayResidentId;
                    BarangayResident::where('id', $barangayResidentId)->update([
                        'barangay_id_number' => $barangayIdNumber,
                    ]);

                    DB::commit();
                    return response()->json(['hasError' => 0]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['hasError' => 1, 'exceptionError' => $e]);
                }
            }
        }else{ /* For Update */
            $validator = Validator::make($data, [
                'user_id' => 'required',
                'gender' => 'required',
                'civil_status' => 'required',
                'birthdate' => 'required|string',
                'age' => 'required|string',
                // 'birth_place' => 'required|string',
                // 'zone' => 'required|string',
                // 'block' => 'required|string',
                // 'lot' => 'required|string',
                // 'street' => 'required|string',
                // 'phase' => 'required|string',
                'nationality' => 'required|string',
                'religion' => 'required|string',
                // 'occupation' => 'required|string',
                // 'monthly_income' => 'required|string',
                // 'phil_health_number' => 'required|string',
                'educational_attainment' => 'required',
                // 'remarks' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
            } else {
                DB::beginTransaction();
                $date = date_create("$request->birthdate");
                $birthdate = date_format($date,"Y-m-d");
                try {
                    /**
                     * For uploading image
                     */
                    $image_name = null;
                    if(isset($request->photo)){
                        $image_file = $request->file('photo');
                        $image_name = $image_file->getClientOriginalName();
                        Storage::putFileAs('public/resident_photo', $request->photo, $image_name);
                    }

                    BarangayResident::where('id', $request->barangay_resident_id)->update([
                        'gender' => $request->gender,
                        'civil_status' => $request->civil_status,
                        'length_of_stay' => $request->length_of_stay,
                        'birthdate' => $birthdate,
                        'age' => $request->age,
                        'birth_place' => $request->birth_place,
                        'zone' => $request->zone,
                        'barangay' => $request->barangay,
                        'municipality' => $request->municipality,
                        'province' => $request->province,
                       // 'phase' => $request->phase,
                        'nationality' => $request->nationality,
                       // 'block' => $request->block,
                        'religion' => $request->religion,
                        'photo' => $image_name,
                        'occupation' => $request->occupation,
                        'monthly_income' => $request->monthly_income,
                        'phil_health_number' => $request->phil_health_number,
                        'educational_attainment' => $request->educational_attainment,
                        'remarks' => $request->remarks,
                        // 'user_id' => $request->user_id,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'last_updated_by' => $_SESSION["session_user_id"]
                    ]);

                    DB::commit();
                    return response()->json(['hasError' => 0]);
                } catch (\Exception $e) {
                    DB::rollback(); 
                    return response()->json(['hasError' => 1, 'exceptionError' => $e]);
                }
            }
        }
    }

    public function getBarangayResidentStats(Request $request)
{
    // Get the statistics for the graph
    $totalResidents = BarangayResident::count();
    $genderStats = BarangayResident::select(DB::raw('gender, COUNT(*) as count'))
        ->groupBy('gender')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->gender => $item->count];
        });

    $ageStats = BarangayResident::select(DB::raw('age, COUNT(*) as count'))
        ->groupBy('age')
        ->orderBy('age')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->age => $item->count];
        });

    $civilStatusStats = BarangayResident::select(DB::raw('civil_status, COUNT(*) as count'))
        ->groupBy('civil_status')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->civil_status => $item->count];
        });

    $data = [
        'totalResidents' => $totalResidents,
        'genderStats' => $genderStats,
        'ageStats' => $ageStats,
        'civilStatusStats' => $civilStatusStats
    ];

    return response()->json($data);
}


    public function getBarangayResidentById(Request $request){
        $barangayResidentDetails = BarangayResident::where('id', $request->barangayResidentId)->get();
        return response()->json(['barangayResidentDetails' => $barangayResidentDetails]);
    }

    public function viewBarangayResidentById(Request $request){
        $viewBarangayResidentDetails = BarangayResident::with('user_info.user_levels', 'barangay_resident_blotter_details')->where('id', $request->barangayResidentId)->get();
        return response()->json(['viewBarangayResidentDetails' => $viewBarangayResidentDetails]);
    }

    public function getUsersWithResidentInfo(Request $request){
        $users = User::with('barangay_resident_info')
                ->has('barangay_resident_info', '<', 1) // this will make the resident is only for 1 user
                ->where('is_deleted', 0) // 0-Active
                ->where('status', '=', '1') // 1-Active
                ->where('is_authenticated', '=', '1') // 1-Yes
                // ->where('user_level_id', '!=', '1') // 1-Admin
                ->get();
        return response()->json(['users' => $users]);
    }

    public function getDataForDashboard(){
        $totalBlotter = User::where('is_authenticated', 1)->get();
        return response()->json(['totalBlotter' => count($totalBlotter)]);
    }

    public function getResidents(Request $request){
        $residentsDetails = BarangayResident::with('user_info', 'barangay_resident_blotter_details')->where('is_deleted', 0) // 0-Active
                ->get();
        return response()->json(['residentsDetails' => $residentsDetails]);
    }

    public function resident_report_pdf(Request $request)
{
    $residentDetails = BarangayResident::with('user_info')->get();

    // Apply filters
    if ($request->gender != null) {
        $residentDetails = $residentDetails->where('gender', $request->gender);
    }
    if ($request->zone != null) {
        $residentDetails = $residentDetails->where('zone', $request->zone);
    }
    if ($request->civil_status != null) {
        $residentDetails = $residentDetails->where('civil_status', $request->civil_status);
    }
    if ($request->age != null) {
        $residentDetails = $residentDetails->where('age', $request->age);
    }
    if ($request->educational_attainment != null) {
        $residentDetails = $residentDetails->where('educational_attainment', $request->educational_attainment);
    }
    if ($request->age_category != null) {
        $residentDetails = $residentDetails->filter(function ($resident) use ($request) {
            $age = Carbon::parse($resident->birthdate)->age;

            switch ($request->age_category) {
                case 'Children':
                    return $age >= 0 && $age <= 14;
                case 'Youth':
                    return $age >= 15 && $age <= 24;
                case 'Adult':
                    return $age >= 25 && $age <= 64;
                case 'Senior':
                    return $age >= 65;
                default:
                    return false;
            }
        });
    }

    // Debugging data
    // dd($residentDetails);

    // Construct the title based on filters
    $filters = [];
    if ($request->gender != null) {
        $filters[] = $request->gender == 1 ? 'Male' : ($request->gender == 2 ? 'Female' : 'Other');
    }
    if ($request->zone != null) {
        $filters[] = 'Zone ' . $request->zone;
    }
    if ($request->civil_status != null) {
        switch ($request->civil_status) {
            case 1:
                $filters[] = 'Single';
                break;
            case 2:
                $filters[] = 'Married';
                break;
            case 3:
                $filters[] = 'Widow/er';
                break;
            case 4:
                $filters[] = 'Annulled';
                break;
            case 5:
                $filters[] = 'Legally Separated';
                break;
            default:
                $filters[] = 'Others';
                break;
        }
    }
    if ($request->age_category != null) {
        $filters[] = $request->age_category;
    }

    $title = 'List of Residents';
    if (count($filters) > 0) {
        $title .= ' - ' . implode(', ', $filters);
    }

    $data = [
        'repub_title' => 'Republika ng Pilipinas',
        'province_title' => 'Lalawigan ng Oriental Mindoro',
        'city_title' => 'Bayan ng Bansud',
        'brgy_title' => "BARANGAY PAG-ASA",
        'telephone_title' => "Telephone No.: (049)-502-6234",
        'title' => $title,
        'data' => $residentDetails,
    ];

    $pdf = PDF::loadView('resident_report_pdf', $data);
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream('Resident Report PDF File.pdf');
}
}