<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'middle_initial' => '',
                'email' => 'admin@example.com',
                'username' => 'admin01',
                'password' => bcrypt('admin'),
                'user_level_id' => 1
            ],
            [
                'firstname' => 'Ben',
                'lastname' => 'Tan',
                'middle_initial' => '',
                'email' => 'staff@example.com',
                'username' => 'staff01',
                'password' => bcrypt('staff'),
                'user_level_id' => 2
            ],
            [
                'firstname' => 'Kate',
                'lastname' => 'Su',
                'middle_initial' => '',
                'email' => 'user@example.com',
                'username' => 'user01',
                'password' => bcrypt('user'),
                'user_level_id' => 3
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Wil',
                'middle_initial' => '',
                'email' => 'other@example.com',
                'username' => 'other01',
                'password' => bcrypt('other'),
                'user_level_id' => 4
            ],
        ];

        DB::table('users')->insert($users);
    }
}

// $table->bigIncrements('id');
//             $table->string('firstname');
//             $table->string('lastname');
//             $table->string('middle_initial')->nullable();
//             $table->string('email')->unique();
//             // $table->timestamp('email_verified_at')->nullable();
//             $table->string('username');
//             $table->string('password');
//             $table->string('status')->nullable()->default(1)->comment = '0-Not Active, 1-Active';
//             $table->tinyInteger('is_password_changed')->nullable()->default(0)->comment = '0-No, 1-Yes';
//             $table->tinyInteger('is_authenticated')->nullable()->default(0)->comment = '0-No, 1-Yes';
//             $table->unsignedBigInteger('user_level_id')->comment = '1-Admin, 2-Staff, 3-User, 4-Others';