<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'user.id' => 1,
            'name' => 'Jane Smith',
            'age' => '15',
            'address' =>'456 Elm St, Springfield, IL 62704',
            'phone' =>'08827462',
            'school' =>'Zenith High School',
        ]);
    }
}
