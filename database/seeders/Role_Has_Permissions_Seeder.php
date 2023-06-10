<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Role_Has_Permissions_Seeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 38; $i++) {
            $user = DB::table('role_has_permissions')->insert([
                'permission_id' => $i,
                'role_id' => '1',
            ]);
        }
    }
}
