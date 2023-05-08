<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = Section::create([
            'section_name' => Str::random(10),
            'description' => Str::random(10),
            'created_by' =>Str::random(10),
        ]);
    }
}
