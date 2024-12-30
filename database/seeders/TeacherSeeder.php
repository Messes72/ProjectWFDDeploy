<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeacherSeeder extends Seeder
{   
    public function run(): void
    {
        Teacher::create([
            'user_id' => 2,
            'name' => 'John Doe',
            'qualification' => 'S1 Pendidikan Matematika',
            'experiences' => '5 tahun mengajar Matematika SMA',
        ]);
    }
}
