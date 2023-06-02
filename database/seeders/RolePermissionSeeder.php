<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' =>  Hash::make('admin123'),
                'user_type' =>  'admin',
                'phone_number' =>  null,
                'gender' =>  null,
                'address' =>  null,
                'dr_lic_num' => null,
                'veh_reg_num' =>  null,
                'dob' =>  null,
                'monthly_income' =>  null,
                'nid' =>  null
            ],[
                'id' => 2,
                'name' => 'Driver User',
                'email' => 'driver@gmail.com',
                'password' =>  Hash::make('driver123'),
                'user_type' =>  'driver',
                'phone_number' =>  '01710987654',
                'gender' =>  'male',
                'address' =>  'Dhaka, bangladesh',
                'dr_lic_num' =>  '9237922',
                'veh_reg_num' =>  'DH-928392',
                'dob' =>  '1995-03-07',
                'monthly_income' =>  '20000',
                'nid' =>  null
            ],[
                'id' => 3,
                'name' => 'Driver User',
                'email' => 'passenger@gmail.com',
                'password' =>  Hash::make('passenger123'),
                'user_type' =>  'passenger',
                'phone_number' =>  '01710987655',
                'gender' =>  'male',
                'address' =>  null,
                'dr_lic_num' => null,
                'veh_reg_num' =>  null,
                'dob' =>  null,
                'monthly_income' =>  null,
                'nid' =>  '6826387682'
            ]
        ]);

        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web'
            ],[
                'id' => 2,
                'name' => 'Passenger',
                'guard_name' => 'web'
            ],[
                'id' => 3,
                'name' => 'Driver',
                'guard_name' => 'web'
            ]
        ]);

        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Model\User',
                'model_id' => 1
            ],[
                'role_id' => 2,
                'model_type' => 'App\Model\User',
                'model_id' => 2
            ],[
                'role_id' => 3,
                'model_type' => 'App\Model\User',
                'model_id' => 3
            ]
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1
            ],[
                'permission_id' => 2,
                'role_id' => 1
            ],[
                'permission_id' => 3,
                'role_id' => 1
            ],[
                'permission_id' => 4,
                'role_id' => 1
            ],[
                'permission_id' => 5,
                'role_id' => 1
            ],[
                'permission_id' => 6,
                'role_id' => 1
            ],[
                'permission_id' => 7,
                'role_id' => 1
            ],[
                'permission_id' => 8,
                'role_id' => 1
            ],[
                'permission_id' => 9,
                'role_id' => 1
            ],[
                'permission_id' => 10,
                'role_id' => 1
            ],[
                'permission_id' => 11,
                'role_id' => 1
            ],[
                'permission_id' => 12,
                'role_id' => 1
            ]
        ]);
    }
}
