<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            ['name' => 'XI TJA 1', 'slug' => 'xi-tja-1'],
            ['name' => 'XI TJA 2', 'slug' => 'xi-tja-2'],
            ['name' => 'XI TJA 3', 'slug' => 'xi-tja-3'],
        ];

        foreach ($classes as $studentClass) {
            $class = new StudentClass();
            $class->name = $studentClass['name'];
            $class->slug = $studentClass['slug'];
            $class->save();
        }
    }
}
