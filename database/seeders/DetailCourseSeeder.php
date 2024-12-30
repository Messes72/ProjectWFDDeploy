<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailCourse;

class DetailCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailCourse::create([
           'teacher_id' => 1,
           'course_id' => 1,
           'period_id' => 1
        ]);
    }
}
