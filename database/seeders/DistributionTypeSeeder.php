<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DistributionType;

class DistributionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Cash Aid',
                'ar_name' => 'إعانة مالية',
                'description' => 'المساعدات المالية والنقدية',
                'icon' => 'bi-cash-coin',
                'color' => 'success',
                'order' => 1,
            ],
            [
                'name' => 'Food Items',
                'ar_name' => 'مواد أغذية',
                'description' => 'المواد الغذائية والأساسية',
                'icon' => 'bi-basket',
                'color' => 'warning',
                'order' => 2,
            ],
            [
                'name' => 'Medicine',
                'ar_name' => 'مواد طبية',
                'description' => 'الأدوية والعلاجات الطبية',
                'icon' => 'bi-capsule',
                'color' => 'danger',
                'order' => 3,
            ],
            [
                'name' => 'Medical Supplies',
                'ar_name' => 'مستلزمات طبية',
                'description' => 'الأدوات والمستلزمات الطبية',
                'icon' => 'bi-bandage',
                'color' => 'info',
                'order' => 4,
            ],
            [
                'name' => 'Clothing',
                'ar_name' => 'ملابس وأحذية',
                'description' => 'الملابس والأحذية والملحقات',
                'icon' => 'bi-bag',
                'color' => 'primary',
                'order' => 5,
            ],
            [
                'name' => 'Education',
                'ar_name' => 'مستلزمات تعليمية',
                'description' => 'المستلزمات التعليمية والكتب',
                'icon' => 'bi-book',
                'color' => 'secondary',
                'order' => 6,
            ],
            [
                'name' => 'Other',
                'ar_name' => 'أشياء أخرى',
                'description' => 'مساعدات أخرى متنوعة',
                'icon' => 'bi-box-seam',
                'color' => 'muted',
                'order' => 7,
            ],
        ];

        foreach ($types as $type) {
            DistributionType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );
        }

        $this->command->info('تم إنشاء أنواع المصروفات بنجاح!');
    }
}

