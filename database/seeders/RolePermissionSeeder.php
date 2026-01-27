<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // إنشاء الصلاحيات
        $permissions = [
            // Users
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Roles
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',

            // Areas
            'view-areas',
            'create-areas',
            'edit-areas',
            'delete-areas',

            // Case Types
            'view-case-types',
            'create-case-types',
            'edit-case-types',
            'delete-case-types',

            // Cases
            'view-cases',
            'create-cases',
            'edit-cases',
            'delete-cases',
            'import-cases',
            'export-cases',
            'print-cases',

            // Aid Distributions
            'view-distributions',
            'create-distributions',
            'scan-barcode',

            // News
            'view-news',
            'create-news',
            'edit-news',
            'delete-news',

            // Services
            'view-services',
            'create-services',
            'edit-services',
            'delete-services',

            // About
            'view-about',
            'edit-about',

            // Board Members
            'view-board-members',
            'create-board-members',
            'edit-board-members',
            'delete-board-members',

            // Contact Messages
            'view-contact-messages',
            'delete-contact-messages',

            // Donation Requests
            'view-donation-requests',
            'edit-donation-requests',
            'delete-donation-requests',

            // Reports
            'view-reports',

            // Terms and Conditions
            'view-terms-and-conditions',
            'edit-terms-and-conditions',

            // Distribution Types
            'manage-distribution-types',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $dataEntryRole = Role::firstOrCreate(['name' => 'Data Entry']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer']);

        // منح كل الصلاحيات للـ Admin
        $adminRole->givePermissionTo(Permission::all());

        // منح صلاحيات محددة للـ Manager
        $managerRole->givePermissionTo([
            'view-users',
            'view-areas',
            'create-areas',
            'edit-areas',
            'view-case-types',
            'create-case-types',
            'edit-case-types',
            'view-cases',
            'create-cases',
            'edit-cases',
            'import-cases',
            'export-cases',
            'print-cases',
            'view-distributions',
            'create-distributions',
            'scan-barcode',

            'view-news',
            'create-news',
            'edit-news',
            'delete-news',

            'view-services',
            'create-services',
            'edit-services',
            'delete-services',

            'view-about',
            'edit-about',

            'view-board-members',
            'create-board-members',
            'edit-board-members',
            'delete-board-members',

            'view-contact-messages',
            'delete-contact-messages',

            'view-donation-requests',
            'edit-donation-requests',
            'delete-donation-requests',

            'view-reports',

            'view-terms-and-conditions',
            'edit-terms-and-conditions',

            'manage-distribution-types',
        ]);

        // منح صلاحيات محددة للـ Data Entry
        $dataEntryRole->givePermissionTo([
            'view-areas',
            'view-case-types',
            'view-cases',
            'create-cases',
            'edit-cases',
            'import-cases',
            'view-distributions',
            'create-distributions',
            'scan-barcode',

            'view-news',
            'create-news',
            'edit-news',

            'view-services',
            'create-services',
            'edit-services',

            'view-about',
            'edit-about',

            'view-board-members',
            'create-board-members',
            'edit-board-members',

            'view-contact-messages',
            'view-donation-requests',

            'view-reports',
        ]);

        $viewerRole->givePermissionTo([
            'view-areas',
            'view-case-types',
            'view-cases',
            'view-distributions',
            'view-news',
            'view-services',
            'view-about',
            'view-board-members',
            'view-contact-messages',
            'view-donation-requests',
            'view-reports',
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@charity.com'],
            [
                'name' => 'المدير',
                'password' => Hash::make('password'),
            ]
        );
        if (! $admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        $this->command->info('تم إنشاء الأدوار والصلاحيات بنجاح!');
    }
}
