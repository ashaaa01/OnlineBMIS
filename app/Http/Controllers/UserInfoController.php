<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangayResident;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserInfoController extends Controller
{
    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $vdata = $request->validate(
            [
                'firstname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                'lastname' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
                'middle_initial' => 'required|string',
                'suffix' => 'nullable|string|max:10', 
                'gender' => 'required|in:1,2,3', 
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
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'required|string|max:255',
                'religion' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'contact_number' => 'required|numeric|min:11',
                'zone' => 'required|integer|min:1|max:9',
                'barangay' => 'nullable|string|max:255',
                'municipality' => 'required|string|max:255',
                'province' => 'nullable|string|max:500',
                'educational_attainment' => 'required|in:1,2,3,4,5,6,7,8,9,10',
                'occupation' => 'nullable|string|max:255',
                'registered_voter' => 'required|in:1,2',
            ], [
                'gender.in' => 'The gender must be one of the following: male, female, or other.',
                'registered_voter.in' => 'The registered voter must be either "Yes" or "No".',
        ]);

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

        $message = "";

        $updateUserData = $request->only(['firstname', 'lastname', 'middle_initial', 'suffix', 'registered_voter', 'voters_id', 'email', 'contact_number', 'gender']);
        $updateUserData['voters_id'] = $voters_id;
        
        $userData = User::findOrFail($user->id);
        $userData->update($updateUserData);
        
        if ($userData->wasChanged()) {
            $message = "Update successfully.";
        } else {
            $message = "No changes were made.";
        }

        $date = date_create("$request->birthdate");
        $birthdate = date_format($date,"Y-m-d");

        $updateResidentData = $request->only([
            'gender',
            'birthdate',
            'age',
            'birth_place',
            'province',
            'zone',
            'barangay',
            'municipality',
            'nationality',
            'religion',
            'occupation',
            'educational_attainment'
        ]);
        $updateResidentData['birthdate'] = $birthdate;
        $updateResidentData['user_id'] = $user->id;

        $residentId = null;
        $barangayResident = BarangayResident::where('user_id', $user->id)->first();
        if($barangayResident){
            $residentId = $barangayResident->id;
        }

        $residentData = BarangayResident::updateOrCreate(['id' => $residentId], $updateResidentData);

        if ($residentData->wasChanged()) {
            $message = "Update successfully.";
        } else {
            $message = "No changes were made.";
        }

        if($message) {
            return response([
                'message' => $message,
            ], 200);
        }
    }
}
