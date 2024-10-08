<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Jobs\SendNewStatus;
use App\Jobs\SendNewPassword;

use Barryvdh\DomPDF\Facade\Pdf;
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
use App\Models\UserLevel;
use App\Models\BarangayResidentDatabase;
use App\Models\BarangayResident;
use App\Models\BarangayResidentBlotter;
use App\Models\BarangayClearanceCertificate;
use App\Models\IndigencyCertificate;
use App\Models\ResidencyCertificate;
use App\Models\RegistrationCertificate;
use App\Models\LicensePermitCertificate;

class UserController extends Controller
{
    public function signIn(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $maxAttempts = 3;
    $decaySeconds = 20; // Set decay time to 20 seconds
    $key = 'login:' . $credentials['username'];

    // Check if the user has made too many login attempts
    if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
        $seconds = RateLimiter::availableIn($key);
        $seconds = min($seconds, $decaySeconds); // Ensure the remaining seconds don't exceed 20

        return response()->json([
            'hasError' => 1,
            'error_message' => 'Your account is temporarily blocked. Please try again in ' . $seconds . ' second(s).',
            'blocked' => true,
            'cooldown' => $seconds
        ]);
    }

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check user account status
        if ($user->is_deleted == 1) {
            Auth::logout();
            return response()->json(['isDeleted' => 1, 'error_message' => 'Your account was already deleted!']);
        } elseif ($user->is_authenticated == 0) {
            Auth::logout();
            return response()->json(['isAuthenticated' => 0, 'error_message' => 'Your account was already registered. Kindly wait for the approval of the Administrator']);
        } elseif ($user->status == 0) {
            Auth::logout();
            return response()->json(['inactive' => 0, 'error_message' => 'Your account is currently deactivated. Kindly contact the Administrator']);
        } else {
            session_start();
            $_SESSION["session_user_id"] = $user->id;
            $_SESSION["session_user_level_id"] = $user->user_level_id;
            $_SESSION["session_username"] = $user->username;
            $_SESSION["session_firstname"] = $user->firstname;
            $_SESSION["session_lastname"] = $user->lastname;
            $_SESSION["session_email"] = $user->email;

            // Clear the rate limiter on successful login
            RateLimiter::clear($key);

            return response()->json(['hasError' => 0]);
        }
    } else {
        // Increment the counter for a given key with the decay time
        RateLimiter::hit($key, $decaySeconds);

        // Check remaining attempts
        if (RateLimiter::attempts($key) >= $maxAttempts) {
            return response()->json([
                'hasError' => 1,
                'error_message' => 'Your account is temporarily blocked due to too many failed login attempts. Please try again later.',
                'blocked' => true,
                'cooldown' => RateLimiter::availableIn($key)
            ]);
        }

        return response()->json([
            'hasError' => 1,
            'error_message' => 'We do not recognize your username and/or password. You have ' . ($maxAttempts - RateLimiter::attempts($key)) . ' attempt(s) left.'
        ]);
    }
}

    public function addUser(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();
        $validator = Validator::make($data, [
            'firstname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'lastname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'middle_initial' => 'required|string',
            'suffix' => 'nullable|string|max:10', 
            'gender' => 'required|in:1,2', 
            'civil_status' => 'required|in:1,2,3,4,5,6',
            'birthdate' => 'required|date|before:today', 
            'age' => [
            'required',
            'integer',
            'min:0',
            'max:120',
            function($attribute, $value, $fail) {
                if ($value <= 14) {
                    $fail('Residents must be older than 14 years old to register.');
                }
            },
        ],
            'length_of_stay_number' => 'required|integer|min:0',
            'length_of_stay_unit' => 'required|in:years,months',
            'permanent_address' => 'nullable|string|max:500',
            'birth_place' => 'nullable|string|max:255',
            'zone' => 'required|integer|min:1|max:9',
            'barangay' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'registered_voter' => 'required|in:1,2',
            'educational_attainment' => 'required|in:1,2,3,4,5,6,7,8,9,10',

            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|min:11',
            'username' => 'required|unique:users,username',

            'password' => 'required|alphaNum|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|alphaNum|min:8',
        ], [
            'gender.in' => 'The gender must be one of the following: male, female, or other.',
            'civil_status.in' => 'The civil status must be one of the following: Single, Married, Widow/er, Annulled, Legally Separated, or Others.',
            'length_of_stay_unit.in' => 'The length of stay unit must be either "years" or "months".',
            'registered_voter.in' => 'The registered voter must be either "Yes" or "No".',
        ]);
        // return $data;

        if ($validator->fails()) {
            return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
        } else {

            /**
             * For uploading image
             */
            $voters_id = null;
            if(isset($request->voters_id)){
                $folder = 'voters_photo';
                $voters_file = $request->file('voters_id');
                $voters_id = $voters_file->getClientOriginalName();
                if (!File::exists($folder)) {
                    File::makeDirectory($folder, 0777, true); // Recursively create directory
                }
                $file = $voters_file;
                $file->move(public_path($folder), $voters_id);
            }

            DB::beginTransaction();
            // try {
                $userId = User::insertGetId([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'middle_initial' => $request->middle_initial,
                    'suffix' => $request->suffix,
                    'registered_voter' => $request->registered_voter,
                    'voters_id' => $voters_id,
                    'email' => $request->email,
                    'contact_number' => $request->mobile_number,
                    'username' => $request->username,
                    'gender' => $request->gender,

                    'password' => Hash::make($request->password),
                    'is_password_changed' => 0,
                    'user_level_id' => 3, // User
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_deleted' => 0
                ]);

                $date = date_create("$request->birthdate");
                $birthdate = date_format($date,"Y-m-d");

                $barangayResidentId = BarangayResident::insertGetId([
                    'gender' => $request->gender,
                    'civil_status' => $request->civil_status,
                    'length_of_stay' => $request->length_of_stay_number,
                    'length_of_stay_unit' => $request->length_of_stay_unit,
                    'birthdate' => $birthdate,
                    'age' => $request->age,
                    'birth_place' => $request->birth_place,
                    'permanent_address' => $request->permanent_address,
                    'zone' => $request->zone,
                    'barangay' => $request->barangay,
                    'province' => $request->province,
                    'municipality' => $request->municipality,
                    'nationality' => $request->nationality,
                    'religion' => $request->religion,
                    'occupation' => $request->occupation,
                    'educational_attainment' => $request->educational_attainment,
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $userId,
                    'is_deleted' => 0,
                    'photo' => '/images/img/user-circle-icon.png'
                ]);

                $barangayIdNumber = "BRGY-PAGASA-" . date("Y") .'-'. $barangayResidentId;
                BarangayResident::where('id', $barangayResidentId)->update([
                    'barangay_id_number' => $barangayIdNumber,
                ]);

                // User::where('id', $userId)->update(['created_by' => $userId]);
                DB::commit();
                return response()->json(['hasError' => 0]);
            // } catch (\Exception $e) {
            //     DB::rollback();
            //     return response()->json(['hasError' => 1, 'exceptionError' => $e]);
            // }
        
            // $userDetails = BarangayResidentDatabase::where('is_deleted', 0)
            //                 ->where('firstname', strtolower($request->firstname) )
            //                 ->where('lastname', strtolower($request->lastname) )
            //                 ->where('middle_initial', strtolower($request->middle_initial) )
            //                 ->get();
            
            // if(count($userDetails) > 0){
            //     if($userDetails[0]->address == "Pag-Asa"){
            //         DB::beginTransaction();
            //         try {
            //             $userId = User::insertGetId([
            //                 'firstname' => $request->firstname,
            //                 'lastname' => $request->lastname,
            //                 'middle_initial' => $request->middle_initial,
            //                 'email' => $request->email,
            //                 'contact_number' => $request->contact_number,
            //                 'username' => $request->username,
            //                 'password' => Hash::make($request->password),
            //                 'is_password_changed' => 0,
            //                 'user_level_id' => 3, // User
            //                 'created_at' => date('Y-m-d H:i:s'),
            //                 'is_deleted' => 0
            //             ]);

            //             // User::where('id', $userId)->update(['created_by' => $userId]);
            //             DB::commit();
            //             return response()->json(['hasError' => 0]);
            //         } catch (\Exception $e) {
            //             DB::rollback();
            //             return response()->json(['hasError' => 1, 'exceptionError' => $e]);
            //         }
            //     }else{
            //         return response()->json(['hasError' => 1]);
            //     }
            // }else{
            //     return response()->json(['hasError' => 1, 'userDetailsCount' => count($userDetails)]);
            // }
            
        }
    }

    public function addUserAsAdmin(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        if(!isset($request->user_id)){
            $validator = Validator::make($data, [
                'firstname' => 'required|regex:/^[\pL\s]+$/u|max:255',
                'lastname' => 'required|regex:/^[\pL\s]+$/u|max:255',
                'email' => 'required|email|unique:users',
                'contact_number' => 'required|numeric|min:11',
                'username' => 'required|unique:users',
               // 'voters_id' => 'required',
                'password' => 'required|alphaNum|min:8|required_with:confirm_password|same:confirm_password',
                'user_level' => 'required',
                'confirm_password' => 'required|alphaNum|min:8'
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
            } else {
                DB::beginTransaction();
                try {
                    $userId = User::insertGetId([
                        'firstname' => ucwords(strtolower($request->firstname)),
                        'lastname' => ucwords(strtolower($request->lastname)),
                        'middle_initial' => ucfirst(strtolower($request->middle_initial)),
                        'suffix' => $request->suffix,
                        'email' => $request->email,
                        'contact_number' => $request->contact_number,
                        'username' => $request->username,
                        'voters_id' => $request->voters_id,
                        'password' => Hash::make($request->password),
                        'is_password_changed' => 0,
                        'user_level_id' => $request->user_level,
                        'created_at' => date('Y-m-d H:i:s'),
                        'is_deleted' => 0
                    ]);
    
                    DB::commit();
                    return response()->json(['hasError' => 0]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['hasError' => 1, 'exceptionError' => $e]);
                }
            }
        }else{
            /**
             * The uniqueness of the email and username should be correct logic.
             */
            $validator = Validator::make($data, [
                'firstname' => 'required|regex:/^[\pL\s]+$/u|max:255',
                'lastname' => 'required|regex:/^[\pL\s]+$/u|max:255',
                'email' => 'required',
                // 'contact_number' => 'required|regex:/^(09|\+639)\d{9}$',
                'contact_number' => 'required|numeric|min:11',
                'username' => 'required',
                // 'voters_id' => 'required',
                'user_level' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
            } else {
                User::where('id', $request->user_id)->update([
                    'firstname' => ucwords(strtolower($request->firstname)),
                        'lastname' => ucwords(strtolower($request->lastname)),
                        'middle_initial' => ucfirst(strtolower($request->middle_initial)),
                    'suffix' => $request->suffix,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'username' => $request->username,
                    'voters_id' => $request->voters_id,
                    'user_level_id' => $request->user_level,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'last_updated_by' => $_SESSION["session_user_id"]
                ]);
                return response()->json(['hasError' => 0, 'session'=> $_SESSION["session_user_id"]]);
            }
        }
        
    }

            public function getData()
            {
                // Query your users
                $users = User::all(); // Adjust to your query
            
                // Add row number to each user
                $users->each(function ($user, $index) {
                    $user->rowNumber = $index + 1; // Assign row number (starting from 1)
                });
            
                return datatables()->of($users)
                    ->addColumn('number', function ($user) {
                        return $user->rowNumber;
                    })
                    // Add other columns as needed
                    ->make(true);
            }

    public function viewUsers(Request $request){
        $userDetails = User::with('user_levels')->where('is_deleted', 0)
        ->where('is_authenticated', 1)
        ->when($request->dateRangeFrom, function ($query) use ($request) {
            return $query ->where('created_at', '>=', $request->dateRangeFrom);
        })
        ->when($request->dateRangeTo, function ($query) use ($request) {
            return $query ->where('created_at', '<=', $request->dateRangeTo);
        })
        ->get();
        
        // Add row numbers to each user detail
            $userDetails->transform(function ($userDetail, $index) {
                $userDetail->rowNumber = $index + 1; // Row number starts from 1
                return $userDetail;
            });

            return DataTables::of($userDetails)
            ->addColumn('number', function ($userDetail) {
                return $userDetail->rowNumber; // Use the added rowNumber property
            })
            ->addColumn('status', function($userDetail){
                $result = "";
                if($userDetail->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Active</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Inactive</span></center>';
                }
                return $result;
            })
            ->addColumn('is_authenticated', function($userDetail){
                $result = "";
                if($userDetail->is_authenticated == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Authorized</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Not Authorized</span></center>';
                }
                return $result;
            })
            ->addColumn('action', function($userDetail){
                if($userDetail->status == 1){
                    $result =   '<center>';
                    $result .=            
                    $result .=            '</button>';

                    if($userDetail->user_level_id != 1){
                        $result .=            '<button type="button" class="btn btn-danger btn-xs text-center actionEditUserStatus mr-1" user-id="' . $userDetail->id . '" user-status="' . $userDetail->status . '" data-bs-toggle="modal" data-bs-target="#modalEditUserStatus" title="Deactivate User">';
                        $result .=                '<i class="fa-solid fa-xl fa-ban"></i>';
                        $result .=            '</button>';
                    }

                    $result .=        '</center>';
                }
                else{
                    $result =   '<center>
                                <button type="button" class="btn btn-primary btn-xs text-center actionEditUser mr-1" user-id="' . $userDetail->id . '" data-bs-toggle="modal" data-bs-target="#modalAddUser" title="Edit User Details">
                                    <i class="fa fa-xl fa-edit"></i> 
                                </button>
                                <button type="button" class="btn btn-warning btn-xs text-center actionEditUserStatus mr-1" user-id="' . $userDetail->id . '" user-status="' . $userDetail->status . '" data-bs-toggle="modal" data-bs-target="#modalEditUserStatus" title="Activate User">
                                    <i class="fa-solid fa-xl fa-arrow-rotate-right"></i>
                                </button>
                            </center>';
                }
                return $result;
            })
            ->addColumn('created_at', function($row){
                $result = "";
                $result .= Carbon::parse($row->created_at)->format('M d, Y h:ia');
                return $result;
            })
        ->rawColumns(['status', 'action', 'is_authenticated', 'created_at'])
        ->make(true);
    }

    public function viewPendingUsers(){
        $userDetails = User::with('user_levels')->where('is_deleted', 0)->where('status', 1)->where('is_authenticated', 0)->get();
        
        $userDetails->transform(function ($userDetail, $index) {
            $userDetail->rowNumber = $index + 1; // Row number starts from 1

            // Length of Stay
        if ($userDetail->barangay_resident_id) {
            $userDetail->length_of_stay = $userDetail->barangay_resident_id->length_of_stay_number . ' ' . $userDetail->barangay_resident_id->length_of_stay_unit;
        } else {
            $userDetail->length_of_stay = '0';
        }
        
        return $userDetail;
    });


        return DataTables::of($userDetails)
        ->addColumn('number', function ($userDetail) {
            return $userDetail->rowNumber; // Use the added rowNumber property
        })
        ->addColumn('length_of_stay', function($userDetail) {
            if ($userDetail->barangay_resident_id) {
                $userDetail->length_of_stay = $userDetail->barangay_resident_id->length_of_stay_number . ' ' . $userDetail->barangay_resident_id->length_of_stay_unit;
            } else {
                $userDetail->length_of_stay = '0';
            }
            return $userDetail->length_of_stay;
        })
            ->addColumn('status', function($userDetail){
                $result = "";
                if($userDetail->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Active</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Inactive</span></center>';
                }
                return $result;
            })
            ->addColumn('is_authenticated', function($userDetail){
                $result = "";
                if($userDetail->is_authenticated == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Authorized</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Not Authorized</span></center>';
                }
                return $result;
            })
            ->addColumn('action', function($userDetail){
                if($userDetail->status == 1){
                    $result =   '<center>
                                
                                <button type="button" class="btn btn-danger btn-xs text-center actionEditUserStatus mr-1" user-id="' . $userDetail->id . '" user-status="3" data-bs-toggle="modal" data-bs-target="#modalEditUserStatus" title="Disapprove User Request">
                                    <i class="fa-solid fa-xl fa-ban"></i>
                                </button>';
                    if($userDetail->is_authenticated == 1){
                        $result .= '<button type="button" class="btn btn-success btn-xs text-center actionEditUserAuthentication" user-id="' . $userDetail->id . '" user-authentication="' . $userDetail->is_authenticated . '" data-bs-toggle="modal" data-bs-target="#modalEditUserAuthentication" title="Approve User Request">
                                        <i class="fa-solid fa-xl fa-ban"></i>
                                    </button>';
                    }else{
                        $result .= '<button type="button" class="btn btn-success btn-xs text-center actionEditUserAuthentication" user-id="' . $userDetail->id . '" user-authentication="' . $userDetail->is_authenticated . '" data-bs-toggle="modal" data-bs-target="#modalEditUserAuthentication" title="Approve User Request">
                                        <i class="fa-solid fa-xl fa-square-check"></i>
                                    </button>';
                    }
                    $result .=  '</center>';
                }else if($userDetail->status == 0){
                    $result =   '<center>
                                <button type="button" class="btn btn-primary btn-xs text-center actionEditUser" user-id="' . $userDetail->id . '" data-bs-toggle="modal" data-bs-target="#modalAddUser" title="Edit User Details">
                                    <i class="fa fa-xl fa-edit"></i> 
                                </button>
                                <button type="button" class="btn btn-warning btn-xs text-center actionEditUserStatus mr-1" user-id="' . $userDetail->id . '" user-status="' . $userDetail->status . '" data-bs-toggle="modal" data-bs-target="#modalEditUserStatus" title="Activate User">
                                    <i class="fa-solid fa-xl fa-arrow-rotate-right"></i>
                                </button>';
                    if($userDetail->is_authenticated == 1){
                        $result .= '<button type="button" class="btn btn-success btn-xs text-center actionEditUserAuthentication" user-id="' . $userDetail->id . '" user-authentication="' . $userDetail->is_authenticated . '" data-bs-toggle="modal" data-bs-target="#modalEditUserAuthentication" title="Approve User Request">
                                        <i class="fa-solid fa-xl fa-ban"></i>
                                    </button>';
                    }else{
                        $result .= '<button type="button" class="btn btn-success btn-xs text-center actionEditUserAuthentication" user-id="' . $userDetail->id . '" user-authentication="' . $userDetail->is_authenticated . '" data-bs-toggle="modal" data-bs-target="#modalEditUserAuthentication" title="Approve User Request">
                                        <i class="fa-solid fa-xl fa-square-check"></i>
                                    </button>';
                    }
                    $result .=  '</center>';
                }
                return $result;
            })
            ->addColumn('voters_id', function($row){
                $result = "";
                
                if($row->voters_id != null){
                    $url = asset("/storage/voters_government_id/$row->voters_id");
                    $result .= '<a href="'.$url.'" target="_blank" data-toggle="lightbox" data-caption="This describes the image">';
                    $result .=    '<center><img width="80" height="80" class="img-fluid rounded" src="'.$url.'"></center>';
                    $result .=  '</a>';
                }else{
                    $result .= '<center><span class="badge badge-pill badge-secondary">No image</span></center>';
                }
                return $result;
            })
        ->rawColumns(['status', 'action', 'is_authenticated','voters_id'])
        ->make(true);
    }
    
    public function viewDisapprovedUsers(Request $request)
    {
        $userDetails = User::with('user_levels')
            ->where('is_deleted', 0)
            ->where('status', 3) // Assuming status = 3 means disapproved
            ->where('is_authenticated', 0)
            ->get();
        
        $userDetails->transform(function ($userDetail, $index) {
            $userDetail->rowNumber = $index + 1; // Row number starts from 1
            return $userDetail;
        });

        return DataTables::of($userDetails)
            ->addColumn('number', function ($userDetail) {
                return $userDetail->rowNumber; // Use the added rowNumber property
            })
            ->addColumn('status', function($userDetail){
                $result = "";
                if($userDetail->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Active</span></center>';
                }
                else  if($userDetail->status == 3){
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Disapproved</span></center>';
                }  else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Inactive</span></center>';
                }
                return $result;
            })
            ->addColumn('is_authenticated', function($userDetail){
                $result = "";
                if($userDetail->is_authenticated == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Authorized</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Not Authorized</span></center>';
                }
                return $result;
            })
            // ->addColumn('action', function($userDetail){
            //     $result = '<center>';
            //     // Add action buttons if needed
            //     $result .= '</center>';
            //     return $result;
            // })
            
            ->addColumn('created_at', function($row){
                $result = Carbon::parse($row->created_at)->format('M d, Y h:ia');
                return $result;
            })
            ->rawColumns(['status', 'action', 'is_authenticated', 'created_at'])
            ->make(true);
    }

    public function getUserById(Request $request){
        $userDetails = User::with('user_levels')->where('id', $request->userId)->get();
        // echo $userDetails; die;
        return response()->json(['userDetails' => $userDetails]);
    }

    public function getUserInformation(){
        $user = Auth::user();
        $userDetails = User::with('user_levels', 'barangay_resident_info')->where('id', $user->id)->first();
        // echo $userDetails; die;
        return view('admin.user_information', compact('userDetails'));
    }

    public function getUserBySessionId(Request $request){
        $userDetails = User::with('user_levels')->where('id', $request->userId)->get();
        // echo $userDetails;
        return response()->json(['userDetails' => $userDetails]);
    }

    public function editUserStatus(Request $request) {
        $data = $request->all(); // Collect all input fields
    
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'status' => 'required|numeric', // Added boolean validation for status
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'validationHasError' => 1,
                'error' => $validator->errors()
            ]);
        }

        $new_status = "";
        if($request->status != 3){
            $status = $request->status == 1 ? 0 : 1; // Toggle status
        } else {
            $status = $request->status;
            $new_status = "Disapproved";
        }
        
    
       User::where('id', $request->user_id)
            ->update([
                'status' => $status,
                'last_updated_by' => session('session_user_id'), // Use session helper
                'updated_at' => now() // Use Laravel's now() helper
            ]);
        
        $user = User::findOrFail($request->user_id);

        $details = [
            'recipient' => $user->email,
            'new_status' => $new_status,
            'first_name' =>$user->firstname,
            'last_name' => $user->lastname,
        ];
        
        if($request->status == 3){
            SendNewStatus::dispatch($details);
        }
    
        return response()->json([
            'hasError' => 0,
            'status' => (int)$status
        ]);
    }
    

    public function editUserAuthentication(Request $request){        
        date_default_timezone_set('Asia/Manila');
        session_start();
    
        $data = $request->all(); // collect all input fields
    
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'authentication' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
        }
    
        try {
            $authStatus = $request->authentication == 1 ? 0 : 1;
            $new_status = "";
            if($authStatus == 1) {
                $new_status = "Approved";
            } else {
                $new_status = "Disapproved";
            }
    
            User::where('id', $request->user_id)
                ->update([
                    'is_authenticated' => $authStatus,
                    'last_updated_by' => $_SESSION['session_user_id'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $user = User::findOrFail($request->user_id);

            $details = [
                'recipient' => $user->email,
                'new_status' => $new_status,
                'first_name' =>$user->firstname,
                'last_name' => $user->lastname,
            ];   
                
            SendNewStatus::dispatch($details);
    
            $authentication = User::where('id', $request->user_id)->value('is_authenticated');
            return response()->json(['hasError' => 0, 'authentication' => (int)$authentication]);
        } catch (\Exception $e) {
            return response()->json(['hasError' => 1, 'exceptionError' => $e->getMessage()]);
        }
    }

    public function getDataForDashboard(){
        date_default_timezone_set('Asia/Manila');
        session_start();
        
        $totalUsers = User::where('is_authenticated', 1)->count();
        $totalPendingUsers = User::where('is_authenticated', 0)->where('status', 1)->count();
        $totalDisapproveUsers = User::where('is_authenticated', 0)->where('status', 3)->count(); // disapprove
        $totalResidents = BarangayResident::where('status', 1)->count();
        $totalBlotters = BarangayResidentBlotter::count();
    
        $totalBarangayClearanceCertificates = BarangayClearanceCertificate::count();
        $totalPendingBarangayClearanceCertificates = BarangayClearanceCertificate::where('status', '3')->count();
        $totalProcessingBarangayClearanceCertificates = BarangayClearanceCertificate::where('status', '2')->count();
        $totalDisapprovedBarangayClearanceCertificates = BarangayClearanceCertificate::where('status', '4')->count();
        $totalApprovedBarangayClearanceCertificates = BarangayClearanceCertificate::where('status', '1')->count();
        
        // 1-Approved, 2-Processing, 3-Pending, 4-Disapproved
        $totalIndigencyCertificates = IndigencyCertificate::count();
        $totalPendingIndigencyCertificates = IndigencyCertificate::where('status', '3')->count();
        $totalProcessingIndigencyCertificates = IndigencyCertificate::where('status', '2')->count();
        $totalDisapprovedIndigencyCertificates = IndigencyCertificate::where('status', '4')->count();
        $totalApprovedIndigencyCertificates = IndigencyCertificate::where('status', '1')->count();

        $totalResidencyCertificates = ResidencyCertificate::count();
        $totalPendingResidencyCertificates = ResidencyCertificate::where('status', '3')->count();
        $totalProcessingResidencyCertificates = ResidencyCertificate::where('status', '2')->count();
        $totalDisapprovedResidencyCertificates = ResidencyCertificate::where('status', '4')->count();
        $totalApprovedResidencyCertificates = ResidencyCertificate::where('status', '1')->count();

        $totalLicensePermitCertificate = LicensePermitCertificate::count();
        $totalPendingLicensePermitCertificate = LicensePermitCertificate::where('status', '3')->count();
        $totalProcessingLicensePermitCertificate = LicensePermitCertificate::where('status', '2')->count();
        $totalDisapprovedLicensePermitCertificate = LicensePermitCertificate::where('status', '4')->count();
        $totalApprovedLicensePermitCertificate = LicensePermitCertificate::where('status', '1')->count();

        $totalRegistrationCertificates = RegistrationCertificate::count();
        $totalLicensePermitCertificates = LicensePermitCertificate::count();
    
        // Count total Barangay Clearance requests for all residents
        $totalBarangayClearanceRequests = BarangayClearanceCertificate::count();
        $totalLicensePermitCertificatesRequests = LicensePermitCertificate::all();
        $totalIndigencyCertificatesRequests = IndigencyCertificate::all();
        $totalResidencyCertificatesRequests = ResidencyCertificate::all();

        $totalMaleChildren = BarangayResident::where('gender', 1)->whereBetween('age', [0, 12])->count();
        $totalMaleYouth = BarangayResident::where('gender', 1)->whereBetween('age', [13, 24])->count();
        $totalMaleAdult = BarangayResident::where('gender', 1)->whereBetween('age', [25, 59])->count();
        $totalMaleSenior = BarangayResident::where('gender', 1)->where('age', '>=', 60)->count();

        $totalFemaleChildren = BarangayResident::where('gender', 2)->whereBetween('age', [0, 12])->count();
        $totalFemaleYouth = BarangayResident::where('gender', 2)->whereBetween('age', [13, 24])->count();
        $totalFemaleAdult = BarangayResident::where('gender', 2)->whereBetween('age', [25, 59])->count();
        $totalFemaleSenior = BarangayResident::where('gender', 2)->where('age', '>=', 60)->count();

        // Gender counts
        $totalMale = BarangayResident::where('gender', 1)->count();
        $totalFemale = BarangayResident::where('gender', 2)->count();
        $totalOther = BarangayResident::where('gender', 3)->count();

        // Age category counts
        $totalChildren = BarangayResident::whereBetween('age', [0, 12])->count();
        $totalYouth = BarangayResident::whereBetween('age', [13, 24])->count();
        $totalAdult = BarangayResident::whereBetween('age', [25, 59])->count();
        $totalSenior = BarangayResident::where('age', '>=', 60)->count();

        $totalUsers = User::where('is_authenticated', 1)->count();

        // Educational attainment counts (example, adjust according to your categories)
        $educationalAttainments = [
            'None' => BarangayResident::where('educational_attainment', 'None')->count(),
            'High School' => BarangayResident::where('educational_attainment', 'High School')->count(),
            'College' => BarangayResident::where('educational_attainment', 'College')->count(),
            'Graduate' => BarangayResident::where('educational_attainment', 'Graduate')->count(),
        ];

        // Civil status counts (example, adjust according to your statuses)
        $civilStatuses = [
            'Single' => BarangayResident::where('civil_status', 'Single')->count(),
            'Married' => BarangayResident::where('civil_status', 'Married')->count(),
            'Widowed' => BarangayResident::where('civil_status', 'Widowed')->count(),
            'Divorced' => BarangayResident::where('civil_status', 'Divorced')->count(),
        ];
        

        
        return response()->json([
            'totalUsers' => $totalUsers, 
            'totalDisapproveUsers' => $totalDisapproveUsers,
            'totalPendingUsers' => $totalPendingUsers,
            'totalResidents' => $totalResidents,
            'totalBlotters' => $totalBlotters,
            'totalLicensePermitCertificatesRequests' => $totalLicensePermitCertificatesRequests,
            'totalResidencyCertificatesRequests' => $totalResidencyCertificatesRequests,
            'totalIndigencyCertificatesRequests' => $totalIndigencyCertificatesRequests,

    
            'totalBarangayClearanceCertificates' => $totalBarangayClearanceCertificates,
            'totalPendingBarangayClearanceCertificates' => $totalPendingBarangayClearanceCertificates,
            'totalProcessingBarangayClearanceCertificates' => $totalProcessingBarangayClearanceCertificates,
            'totalDisapprovedBarangayClearanceCertificates' => $totalDisapprovedBarangayClearanceCertificates,
            'totalApprovedBarangayClearanceCertificates' => $totalApprovedBarangayClearanceCertificates,

            'totalIndigencyCertificates' => $totalIndigencyCertificates,
            'totalPendingIndigencyCertificates' => $totalPendingIndigencyCertificates,
            'totalProcessingIndigencyCertificates' => $totalProcessingIndigencyCertificates,
            'totalDisapprovedIndigencyCertificates' => $totalDisapprovedIndigencyCertificates,
            'totalApprovedIndigencyCertificates' => $totalApprovedIndigencyCertificates,
            

            'totalResidencyCertificates' => $totalResidencyCertificates,
            'totalPendingResidencyCertificates' => $totalPendingResidencyCertificates,
            'totalProcessingResidencyCertificates' => $totalProcessingResidencyCertificates,
            'totalDisapprovedResidencyCertificates' => $totalDisapprovedResidencyCertificates,
            'totalApprovedResidencyCertificates' => $totalApprovedResidencyCertificates,

            'totalLicensePermitCertificate' => $totalLicensePermitCertificate,
            'totalPendingLicensePermitCertificate' => $totalPendingLicensePermitCertificate,
            'totalProcessingLicensePermitCertificate' => $totalProcessingLicensePermitCertificate,
            'totalDisapprovedLicensePermitCertificate' => $totalDisapprovedLicensePermitCertificate,
            'totalApprovedLicensePermitCertificate' => $totalApprovedLicensePermitCertificate,

            'totalRegistrationCertificates' => $totalRegistrationCertificates,
            'totalLicensePermitCertificates' => $totalLicensePermitCertificates,
        
            // Gender and Age Category counts
        'totalMaleChildren' => $totalMaleChildren,
        'totalMaleYouth' => $totalMaleYouth,
        'totalMaleAdult' => $totalMaleAdult,
        'totalMaleSenior' => $totalMaleSenior,

        'totalFemaleChildren' => $totalFemaleChildren,
        'totalFemaleYouth' => $totalFemaleYouth,
        'totalFemaleAdult' => $totalFemaleAdult,
        'totalFemaleSenior' => $totalFemaleSenior,

            'totalChildren' => $totalChildren,
            'totalYouth' => $totalYouth,
            'totalAdult' => $totalAdult,
            'totalSenior' => $totalSenior,

             // Gender counts
             'totalMale' => $totalMale,
             'totalFemale' => $totalFemale,
             'totalOther' => $totalOther,
    
            // For User Dashboard
            'totalBarangayClearanceRequests' => $totalBarangayClearanceRequests,

            'totalUsers' => $totalUsers,
        ]);
    }
    



    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        Auth::logout();
        return response()->json(['result' => "1"]);
    }

    public function checkSession(){
        session_start();
        $session = $_SESSION;
        return response()->json(['session' => $session]);
    }


    public function getUserLevels(Request $request){
        $userLevels = UserLevel::where('is_deleted', 0)->get();
        return response()->json(['userLevels' => $userLevels]);
    }


    public function viewPendingUsersForDashboard(){
        $userDetails = User::with('user_levels')->where('is_deleted', 0)->where('is_authenticated', 0)->get();
        
        return DataTables::of($userDetails)
            ->addColumn('status', function($userDetail){
                $result = "";
                if($userDetail->status == 1){
                    $result .= '<center><span class="badge badge-pill badge-success">Active</span></center>';
                }
                else{
                    $result .= '<center><span class="badge badge-pill text-secondary" style="background-color: #E6E6E6">Inactive</span></center>';
                }
                return $result;
            })
            ->addColumn('fullname', function($userDetail){
                $result = "";
                
                $result .= '<center>'.$userDetail->firstname .' '. $userDetail->lastname.' '. $userDetail->middle_initial.'</center>';
                return $result;
            })
        ->rawColumns(['status', 'fullname'])
        ->make(true);
    }

    public function residentAddressChecker(Request $request){
        $userDetails = User::where('is_deleted', 0)
                            ->where('firstname', 'like', '%' . $request->firstname . '%')
                            ->where('lastname', 'like', '%' . $request->lastname . '%')
                            ->get();
        return response()->json(['userDetails' => $userDetails]);
    }

    public function getUsers(Request $request){
        $users = User::where('is_deleted', 0) // 0-Active
                ->where('status', '=', '1') // 1-Active
                ->where('is_authenticated', '=', '1') // 1-Yes
                // ->where('user_level_id', '!=', '1') // 1-Admin
                ->get();
        return response()->json(['users' => $users]);
    }

    /**
     * For Profile update
     */
    public function editUser(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        if(isset($request->user_id)){
            /**
             * The uniqueness of the email and username should be correct logic.
             */
            $validator = Validator::make($data, [
                'firstname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                'lastname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                'email' => 'required',
                'contact_number' => 'required|numeric|min:11', // 'contact_number' => 'required|regex:/^(09|\+639)\d{9}$',
                'username' => 'required',
                'password' => 'nullable|string|required_with:new_password',
                'new_password' => 'nullable|alphaNum|min:8|required_with:confirm_password|required_with:password|same:confirm_password',
                'confirm_password' => 'nullable|alphaNum|min:8'
            ]);

            if(isset($request->password)){
                $user = User::findOrFail($request->user_id);
                if (!Hash::check($request->password, $user->password)) {
                    return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
                }  
            }
    
            if ($validator->fails()) {
                return response()->json(['validationHasError' => 1, 'error' => $validator->errors()]);
            } else {    
                User::where('id', $request->user_id)->update([
                    'firstname' => strtolower($request->firstname),
                    'lastname' => strtolower($request->lastname),
                    'middle_initial' => strtolower($request->middle_initial),
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'username' => $request->username,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'last_updated_by' => $_SESSION["session_user_id"]
                ]);

                $logout = false;

                if(isset($request->new_password)){
                    $logout = true;
                    User::where('id', $request->user_id)->update([
                        'password' => Hash::make($request->new_password),
                    ]);
                }
                return response()->json(['hasError' => 0, 'session'=> $_SESSION["session_user_id"], 'logout'=> $logout]);
            }
        }
        
    }


    public function user_report_pdf(Request $request)
    {
        $userDetails = User::with('barangay_resident_info', 'user_levels')
            ->get();
        // return $userDetails;
        $data = [
            'repub_title' => 'Republika ng Pilipinas',
            'province_title' => 'Lalawigan ng Oriental Mindoro',
            'city_title' => 'Bayan ng Bansud',
            'brgy_title' => "BARANGAY PAG-ASA",
            'telephone_title' => "Telephone No.: (049)-502-6234",
            'data' => $userDetails,
        ];

        $pdf = PDF::loadView('user_report_pdf', $data);

        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('User Report PDF File'.".pdf");
    }

    public function getUsersData(Request $request)
    {
        $query = User::query();

        // Apply filters
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        if ($request->has('zone') && $request->zone != '') {
            $query->where('zone', $request->zone);
        }

        // Apply date range filter if needed
        if ($request->has('from') && $request->has('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        return DataTables::of($query)->make(true);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make([
            'email' => $request->email
        ], [
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) {
            return response($validator->errors()->messages(), Response::HTTP_BAD_REQUEST);
        }

        $newPassword = Str::random(8);
        $hashedPassword = bcrypt($newPassword);

        DB::table('users')->where('email', $request->email)->update(['password' => $hashedPassword]);

        $details = [
            'recipient' => $request->email,
            'newPassword' => $newPassword
        ];

        SendNewPassword::dispatch($details);

        return response(['message' => 'Password has been reset successfully. Please check your email.'], Response::HTTP_OK);
    }
}

