<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Period;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Membuat beberapa periode untuk tahun dan semester tertentu
         Period::create([
            'year' => 2024,
            'semester' => 'Spring',  // Misalnya 'Spring' untuk semester Genap
            'active' => true,        // Status periode aktif
        ]);

        Period::create([
            'year' => 2024,
            'semester' => 'Fall',    // Misalnya 'Fall' untuk semester Ganjil
            'active' => false,       // Status periode tidak aktif
        ]);
    }
}
