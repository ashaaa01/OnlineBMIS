<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

/**
 * Import Models here
 */
use App\Models\UserLevel;
use App\Models\BarangayResident;

class User extends Authenticatable // Authenticatable this will allow the use of Auth::user()
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'middle_initial',
        'suffix',
        'registered_voter',
        'voters_id',
        'email',
        'contact_number',
        'username',
        'gender'
    ];
   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_levels(){
        return $this->hasOne(UserLevel::class, 'id', 'user_level_id');
    }

    public function barangay_resident_info(){
        return $this->hasOne(BarangayResident::class, 'user_id')->withDefault([
            'id' => '',
            'barangay_id_number' => '',
            'age' => '',
            'gender' => '',
            'length_of_stay' => '',
            'civil_status' => '',
            'length_of_stay_unit' => '',
            'birthdate' => '',
            'birth_place' => '',
            'permanent_address' => '',
            'zone' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'phase' => '',
            'nationality' => '',
            'occupation' => '',
            'monthly_income' => '',
            'phil_health_number' => '',
            'religion' => '',
            'education_attainment' => '',
            'photo' => '',
            'remarks' => '',
            'status' => '',
            'user_id' => '',
            'is_deleted' => '',
            'created_by' => '',
            'last_updated_by' => '',
            'created_at' => '',
            'updated_at' => '',
        ]);
    }
}
