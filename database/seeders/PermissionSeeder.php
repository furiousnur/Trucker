<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
              [
                  'name' => 'role-list',
                  'guard_name' => 'web'
              ],[
                  'name' => 'role-create',
                  'guard_name' => 'web'
              ],[
                  'name' => 'role-edit',
                  'guard_name' => 'web'
              ],[
                  'name' => 'role-delete',
                  'guard_name' => 'web'
              ],[
                  'name' => 'role-sidebar',
                  'guard_name' => 'web'
              ],
            [
                'name' => 'user-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'dashboard-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'location-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'location-price-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'booking-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'passenger-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'driver-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-location',
                'guard_name' => 'web'
            ],
            [
                'name' => 'set-location-price',
                'guard_name' => 'web'
            ]
        ]);
    }
}
