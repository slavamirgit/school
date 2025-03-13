<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            GradeSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Slava Mir',
            'email' => 'mirgmail@yandex.ru',
            'password' => 'password',
            'role_id' => 1,
        ]);

        User::factory(12)->create([
            'password' => 'password'
        ])->each(function ($user) {
            $grades = Grade::inRandomOrder()->limit(rand(7, 9))->get();
            $user->grades()->attach($grades);
        });

        Student::factory(720)->create();
    }
}
