<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'الفواتير',
            'القائمه الكامله للفواتير',
            'الفواتير المدفوعه',
            'الفواتير غير المدفوعه ',
            'الفواتير المدفوعه جزئيا',
            'ارشيف الفواتير',
            'التقارير',
            'تقارير الفواتير',
            'تقارير العملاء',
            'المستخدمين',
            'قائمه المستخدمين',
            'صلاحيات المستخدمين',
            'الاعدادات',
            'المنتجات',
            'الاقسام',
            'اضافة فاتورة',
            'حذف الفاتورة',
            'تصدير EXCEL',
            'تغير حالة الدفع',
            'تعديل الفاتورة',
            'ارشفة الفاتورة',
            'طباعةالفاتورة',
            'اضافة مرفق',
            'حذف المرفق',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',
            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',
            'الاشعارات',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
