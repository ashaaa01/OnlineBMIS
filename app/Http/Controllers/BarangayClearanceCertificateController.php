<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth; // or use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Yajra\DataTables\Facades\DataTables; // Import the DataTables facade
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
use DOMElement;
use DOMXPath;
use Dompdf\Dompdf;
use Dompdf\Helpers;
use Dompdf\Exception;
use Dompdf\FontMetrics;

// Import Models here
use App\Models\User;
use App\Models\BarangayResident;
use App\Models\BarangayClearanceCertificate;


class BarangayClearanceCertificateController extends Controller
{
    public function viewBarangayClearanceCertificate(){
        $barangayClearanceCertificateDetails = BarangayClearanceCertificate::with('resident_info.user_info')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return DataTables::of($barangayClearanceCertificateDetails)
    
            ->addColumn('action', function($row){
                $result = '<center>';
                $result .= '<button type="button" class="btn btn-primary btn-xs text-center actionEditBarangayClearanceCertificate mr-1" barangay-clearance-certificate-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#modalAddBarangayClearanceCertificate" title="Edit Details">';
                $result .= '<i class="fa fa-xl fa-edit"></i>';
                $result .= '</button>';
                if($row->status != 4){
                    $result .= '<a href="barangay_clerance_pdf/'.$row->id.'" class="btn btn-info btn-xs text-center actionPrintBarangayClearanceCertificate mr-1" barangay-clearance-certificate-id="' . $row->id . '" title="Print Certificate">';
                    $result .= '<i class="fa fa-xl fa-print"></i>';
                    $result .= '</a>';
                }
                $result .= '</center>';
                return $result;
            })
            ->addColumn('gender', function($row){
                if (isset($row->resident_info) && isset($row->resident_info->gender)) {
                    $gender = $row->resident_info->gender;
                    switch($gender) {
                        case 1:
                            return '<center><span>Male</span></center>';
                        case 2:
                            return '<center><span>Female</span></center>';
                        default:
                            return '<center><span>Other</span></center>';
                    }
                }
                return '<center><span>Unknown</span></center>';
            })
            ->addColumn('civil_status', function($row){
                if (isset($row->resident_info) && isset($row->resident_info->civil_status)) {
                    $civil_status = $row->resident_info->civil_status;
                    switch($civil_status) {
                        case 1:
                            return '<center><span>Single</span></center>';
                        case 2:
                            return '<center><span>Married</span></center>';
                        case 3:
                            return '<center><span>Widow/er</span></center>';
                        case 4:
                            return '<center><span>Annulled</span></center>';
                        case 5:
                            return '<center><span>Legally Separated</span></center>';
                        case 6:
                            return '<center><span>Others</span></center>';
                        default:
                            return '<center><span>Unknown</span></center>';
                    }
                }
                return '<center><span>Unknown</span></center>';
            })
            ->addColumn('status', function($row){
                $status = $row->status;
                switch($status) {
                    case 1:
                        return '<center><span class="badge badge-pill badge-success">Issued</span></center>';
                    case 2:
                        return '<center><span class="badge badge-pill badge-primary">For Issuance</span></center>';
                    case 3:
                        return '<center><span class="badge badge-pill badge-secondary">On Process</span></center>';
                    default:
                        return '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">On Process</span></center>';
                }
            })
        ->rawColumns(['action', 'gender', 'civil_status', 'status'])
        ->make(true);
    }
    

    public function addBarangayClearanceCertificate(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        /* For Insert */
        if(!isset($request->barangay_clearance_certificate_id)){
            $validator = Validator::make($data, [
                'barangay_resident_id' => 'required',
                'purpose' => 'required',
                'or_number' => 'required',
                'amount_collection' => 'required',
                'issued_on' => 'required',
                // 'status' => 'required',
                // 'remarks' => 'required',
                
                'issuance_configuration_id' => 'required',
                'total_amount_paid' => 'required',
                'cedula_processing_time' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()->all()]);
            } else {
                DB::beginTransaction();
                
                try {
                    $barangayClearanceId = BarangayClearanceCertificate::insertGetId([
                        'barangay_resident_id' => $request->barangay_resident_id,
                        'purpose' => $request->purpose,
                        'or_number' => $request->or_number,
                        'amount_collection' => $request->amount_collection,
                        'issued_on' => $request->issued_on,
                        'remarks' => $request->remarks,
                        'status' => $request->status, // 1-Approved, 2-Processing, 3-Pending, 4-Disapproved
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $_SESSION["session_user_id"],
                        'is_deleted' => 0,

                        'issuance_configuration_id' => $request->issuance_configuration_id,
                        'total_amount_paid' => $request->total_amount_paid,
                        'cedula_processing_time' => $request->cedula_processing_time,
                    ]);

                    $ticketDate = date("Y-m-d");
                    $ticketNumber = "TN-" . date("Ymd") .'-'. $barangayClearanceId;
                    BarangayClearanceCertificate::where('id', $barangayClearanceId)->update([
                        'ticket_number' => $ticketNumber,
                        'ticket_datetime' => $ticketDate,
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
                'barangay_resident_id' => 'required',
                'purpose' => 'required',
                'or_number' => 'required',
                'amount_collection' => 'required',
                'issued_on' => 'required',
                // 'status' => 'required',
                // 'remarks' => 'required',

                'issuance_configuration_id' => 'required',
                'total_amount_paid' => 'required',
                'cedula_processing_time' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()->all()]);
            } else {
                DB::beginTransaction();
                try {
                    BarangayClearanceCertificate::where('id', $request->barangay_clearance_certificate_id)->update([
                        'barangay_resident_id' => $request->barangay_resident_id,
                        'purpose' => $request->purpose,
                        'or_number' => $request->or_number,
                        'amount_collection' => $request->amount_collection,
                        'issued_on' => $request->issued_on,
                        'remarks' => $request->remarks,
                        'status' => $request->status, // 1-Approved, 2-Processing, 3-Pending, 4-Disapproved
                        'updated_at' => date('Y-m-d H:i:s'),
                        'last_updated_by' => $_SESSION["session_user_id"],

                        'issuance_configuration_id' => $request->issuance_configuration_id,
                        'total_amount_paid' => $request->total_amount_paid,
                        'cedula_processing_time' => $request->cedula_processing_time,
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

    public function getBarangayClearanceCertificateById(Request $request){
        $barangayClearanceCertificateDetails = BarangayClearanceCertificate::with('issuance_configuration_info')->where('id', $request->barangayClearanceCertificateId)->get();
        return response()->json(['barangayClearanceCertificateDetails' => $barangayClearanceCertificateDetails]);
    }

    /**
     * PDF
     */
    public function barangay_clerance_pdf(Request $request, $id)
{
    $barangayResidentDetails = BarangayClearanceCertificate::with(['resident_info.user_info', 'issuance_configuration_info'])
        ->where('id', $id)
        ->where('is_deleted', 0)
        ->orderBy('id', 'desc')
        ->get();

    // Helper functions to convert codes to text
    $getGenderText = function($genderCode) {
        switch ($genderCode) {
            case 1: return 'Male';
            case 2: return 'Female';
            default: return 'Other';
        }
    };

    $getCivilStatusText = function($civilStatusCode) {
        switch ($civilStatusCode) {
            case 1: return 'Single';
            case 2: return 'Married';
            case 3: return 'Widow/er';
            case 4: return 'Annulled';
            case 5: return 'Legally Separated';
            case 6: return 'Others';
            default: return 'Unknown';
        }
    };

    $getEducationalAttainmentText = function($educationCode) {
        switch ($educationCode) {
            case 1: return 'Elementary Graduate';
            case 2: return 'Elementary Undergraduate';
            case 3: return 'High School Graduate';
            case 4: return 'High School Undergraduate';
            case 5: return 'College Graduate';
            case 6: return 'College Undergraduate';
            case 7: return 'Masters Graduate';
            case 8: return 'Some/Completed Masters Degree';
            case 9: return 'Vocational';
            case 10: return 'Others';
            default: return 'Unknown';
        }
    };

    $getZoneText = function($zoneCode) {
        // Define your zone mappings here
        $zoneMap = [
            1 => 'Zone 1',
            2 => 'Zone 2',
            3 => 'Zone 3',
            4 => 'Zone 4',
            5 => 'Zone 5',
            6 => 'Zone 6',
            7 => 'Zone 7',
            8 => 'Zone 8',
            9 => 'Zone 9',
            // Add more zones as needed
        ];
        return $zoneMap[$zoneCode] ?? 'Unknown Zone';
    };

    // Format the date and convert values to text
    foreach ($barangayResidentDetails as $item) {
        $item->issued_on = Carbon::parse($item->issued_on)->format('Y-m-d');
        $item->resident_info->gender_text = $getGenderText($item->resident_info->gender);
        $item->resident_info->civil_status_text = $getCivilStatusText($item->resident_info->civil_status);
        $item->resident_info->educational_attainment_text = $getEducationalAttainmentText($item->resident_info->educational_attainment);
        $item->resident_info->zone_text = $getZoneText($item->resident_info->zone);
        
        // Concatenate address fields
        $addressParts = [
            $item->resident_info->zone_text,
            $item->resident_info->street,
            $item->resident_info->barangay,
            $item->resident_info->municipality,
            $item->resident_info->province
        ];
        
        // Remove empty parts and join with commas
        $item->resident_info->full_address = implode(', ', array_filter($addressParts));
    }

    $data = [
        'repub_title' => 'Republic of the Philippines',
        'province_title' => 'Province of Oriental Mindoro',
        'city_title' => 'Municipality of Bansud',
        'brgy_title' => "BARANGAY PAG-ASA",
        'data' => $barangayResidentDetails,
        'amount_collection' => $barangayResidentDetails->first()->amount_collection,
        'or_number' => $barangayResidentDetails->first()->or_number,
        'purpose' => $barangayResidentDetails->first()->purpose,
        'logoleft' => public_path('images/svg/bansudlogo.png'),
        'logoright' => public_path('images/svg/palogo.png'),
    ];

    $pdf = PDF::loadView('barangay_clearance_pdf', $data);
    return $pdf->stream('Barangay Clearance PDF File' . ".pdf");
}



    public function getTotalBarangayClearanceRequests()
    {
    $totalRequests = BarangayClearanceCertificate::count();
    return response()->json(['totalRequests' => $totalRequests]);
}


        // $first_name = $barangayResidentDetails[2]->firstname;
        // $middle_initial = $barangayResidentDetails[2]->middle_initial;
        // $lastname = $barangayResidentDetails[2]->lastname;
        // $age = $barangayResidentDetails[2]->age;
        // $address = $barangayResidentDetails[2]->address;

        // $first_middle_array = array($first_name,$middle_initial);
        // $imploded_first_middle = implode(" ",$first_middle_array);
        // $name_lastname_array = array($lastname,$imploded_first_middle);

        // $imploded_name = implode(", ",$name_lastname_array);

        // return $imploded_name;

        // return $barangayResidentDetails;

       // $data = [
       //     'repub_title' => 'Republic of the Philippines',
       //     'province_title' => 'Province of Oriental Mindoro',
       //     'city_title' => 'Municipality of Bansud',
       //     'brgy_title' => "BARANGAY PAG-ASA",
       //    // 'telephone_title' => "Telephone No.: (049)-502-6234",
       //     'data' => $barangayResidentDetails,
            // 'name' => $imploded_name,
            // 'age' => $age,
            // 'address' => $address,
       // ];

       // $pdf = PDF::loadView('barangay_clearance_pdf', $data);

        // $pdf->setPaper('A5', 'Landscape');
       // return $pdf->stream('Barangay Clearance PDF File'.".pdf");
   // }

    public function barangay_clearance_certificates_report_pdf(Request $request)
    {
        $barangayClearanceCertificatesDetails = BarangayClearanceCertificate::with(['resident_info.user_info', 'issuance_configuration_info'])
            ->get();
        // return $barangayClearanceCertificatesDetails;
        $data = [
            'repub_title' => 'Republic of the Philippines',
            'province_title' => 'Province of Oriental Mindoro',
            'city_title' => 'Municipality of Bansud',
            'brgy_title' => "BARANGAY PAG-ASA",
           // 'telephone_title' => "Telephone No.: (049)-502-6234",
            'data' => $barangayClearanceCertificatesDetails,
        ];

        $pdf = PDF::loadView('barangay_clearance_certificate_report_pdf', $data);

        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Brgy. Clearance Certificate Report PDF File'.".pdf");
    }

    /**
     * For User
     * Requests Certificate
     */

    public function viewRequestBarangayClearanceCertificate(Request $request){
        $userId = $request->userId;
        $barangayClearanceCertificateDetails = BarangayClearanceCertificate::with('resident_info.user_info')
        ->whereHas('resident_info.user_info', function($query) use($userId){
            $query->where('id', $userId);
        })
        ->where('is_deleted', 0)
        ->orderBy('id', 'desc')
        ->get();
        // return $barangayClearanceCertificateDetails;
        return DataTables::of($barangayClearanceCertificateDetails)
            ->addColumn('gender', function($row){
                $result = "";
                if($row->resident_info?->gender == 1){
                    $result .= '<center><span>Male</span></center>';
                }
                else if($row->resident_info?->gender == 2){
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
                if($row->resident_info->civil_status == 1){
                    $result .= '<center><span>Single</span></center>';
                }
                else if($row->resident_info->civil_status == 2){
                    $result .= '<center><span>Married</span></center>';
                }
                else if($row->resident_info->civil_status == 3){
                    $result .= '<center><span>Widow/er</span></center>';
                }
                else if($row->resident_info->civil_status == 4){
                    $result .= '<center><span>Annulled</span></center>';
                }
                else if($row->resident_info->civil_status == 5){
                    $result .= '<center><span>Legally Separated</span></center>';
                }
                else if($row->resident_info->civil_status == 6){
                    $result .= '<center><span>Others</span>';
                }
                return $result;
            })
            ->addColumn('status', function($row){
                // 1-Approved, 2-Processing, 3-Pending, 4-Disapproved
                $result = "";
                if($row->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Issued</span></center>';
                }
                else if($row->status == 2){
                    $result .= '<center><span class="badge badge-pill badge-primary">For Issuance</span></center>';
                }
                else if($row->status == 3){
                    $result .= '<center><span class="badge badge-pill text-secondary">On Process</span></center>';
                }
               // else if($row->status == 4){
               //     $result .= '<center><span class="badge badge-pill badge-danger">Disapproved</span></center>';
               // }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">On Process</span></center>';
                }
                return $result;
            })
            ->addColumn('ticket_datetime', function($row){
                $result = "";
                $result .= Carbon::parse($row->ticket_datetime)->format('M d, Y h:ia');
                return $result;
            })
        ->rawColumns(['gender', 'civil_status', 'status'])
        ->make(true);
    }
        public function certificateReport()
        {
        return view('certificates_reports'); // return the Blade view
        }

        public function getBarangayClearanceData(Request $request)
        {
            $data = BarangayClearanceCertificate::with('resident_info.user_info')
                ->where('is_deleted', 0)
                ->orderBy('id', 'desc')
                ->get();
        
                return DataTables::of($data)
                ->addColumn('requested_document', function($row) {
                    return 'Barangay Clearance'; // Adjust according to your document type
                })
                ->addColumn('requested_by', function($row) {
                    $firstname = $row->resident_info->user_info->firstname ?? '';
                    $lastname = $row->resident_info->user_info->lastname ?? '';
                    $middle_initial = $row->resident_info->user_info->middle_initial ?? '';
            
                    // Construct the full name
                    $full_name = $firstname;
                    if (!empty($middle_initial)) {
                        $full_name .= ' ' . substr($middle_initial, 0, 1) . '.';
                    }
                    $full_name .= ' ' . $lastname;
            
                    return $full_name;
                })
                ->addColumn('or_number', function($row) {
                    return $row->or_number ?? '';
                })
                ->addColumn('purpose', function($row) {
                    return $row->purpose ?? '';
                })
                ->addColumn('amount_collected', function($row) {
                    return $row->amount_collected ?? '';
                })
                ->addColumn('requested_date', function($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                })
                ->addColumn('remarks', function($row) {
                    return $row->remarks ?? '';
                })
                ->make(true);
                }
        
public function certificateReportPdf()
{
    $data = BarangayClearanceCertificate::with('resident_info.user_info')
        ->where('is_deleted', 0)
        ->orderBy('id', 'desc')
        ->get();

    $pdf = PDF::loadView('certificate_report_pdf', ['data' => $data]);
    return $pdf->download('certificate_report.pdf');
}

    public function addRequestBarangayClearanceCertificate(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        
        $data = $request->all();
        
        $barangayResidentId = BarangayResident::
            where('user_id', $request->user_id)
            ->first();
            // return $barangayResidentId;
            
        /* For Insert */
        if(!isset($request->request_barangay_clearance_certificate_id)){
            $validator = Validator::make($data, [
                'user_id' => 'required',
                'purpose' => 'required',
                // 'or_number' => 'required',
                // 'amount_collection' => 'required',
                // 'issued_on' => 'required',
                // 'status' => 'required',
                // 'remarks' => 'required',
                'issuance_configuration_id' => 'required',
                'total_amount_paid' => 'required',
                'cedula_processing_time' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()->all()]);
            } else {
                DB::beginTransaction();
                
                try {
                    $barangayClearanceCertificateId = BarangayClearanceCertificate::insertGetId([
                        'barangay_resident_id' => $barangayResidentId->id,
                        'purpose' => $request->purpose,
                        'issuance_configuration_id' => $request->issuance_configuration_id,
                        'total_amount_paid' => $request->total_amount_paid,
                        // 'or_number' => $request->or_number,
                        // 'amount_collection' => $request->amount_collection,
                        // 'issued_on' => $request->issued_on,
                        'remarks' => $request->remarks,
                        'status' => 3, // 1-Approved, 2-Processing, 3-Pending, 4-Disapproved
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $_SESSION["session_user_id"],
                        'is_deleted' => 0
                    ]);

                    $ticketDate = date("Y-m-d");
                    $ticketNumber = "TN-" . date("Ymd") .'-'. $barangayClearanceCertificateId;
                    BarangayClearanceCertificate::where('id', $barangayClearanceCertificateId)->update([
                        'ticket_number' => $ticketNumber,
                        'ticket_datetime' => $ticketDate,
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
}
