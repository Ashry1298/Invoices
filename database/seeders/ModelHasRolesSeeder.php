<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user= DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type'=>'App\Models\User',
            'model_id'=>'1',    
        
        ]);
    }
}
