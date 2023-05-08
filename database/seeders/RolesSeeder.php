<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user= DB::table('roles')->insert([
            'name' => 'owner',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        
    }
}
