<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //    $user= DB::table('users')->insert([
    //         'name' => Str::random(0).'admin',
    //         'email' => Str::random(0).'admin@gmail.com',
    //         'password' => Hash::make('123456789'),
    //         'roles_name'=>'"owner"',
    //         'status'=>'غير مفعل',
    //     ]);
    }
}
