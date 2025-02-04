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
        $permissions = [
            [
                'name' => 'role-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web'
            ],
            [
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
                'name' => 'cancel-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-location',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-location',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-location',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-location-price',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-location-price',
                'guard_name' => 'web'
            ],
            [
                'name' => 'set-location-price',
                'guard_name' => 'web'
            ],
            [
                'name' => 'reject-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'accept-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'payment-sidebar',
                'guard_name' => 'web'
            ],
            [
                'name' => 'settings-sidebar',
                'guard_name' => 'web'
            ]
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],
                $permission
            );
        }
    }
}
