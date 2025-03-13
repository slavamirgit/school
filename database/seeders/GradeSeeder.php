<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letters = ['A', 'B', 'C'];

        for ($number = 1; $number < 13; $number++) {
            foreach ($letters as $letter) {
                Grade::create([
                    'name' => $number . $letter
                ]);
            }
        }
    }
}
