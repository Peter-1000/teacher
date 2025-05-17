<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = Teacher::query()->where('email', 'teacher@gmail.com')->first();

        if (!$teacher) {
            // Make teacher for login
            Teacher::query()->firstOrCreate([
                'name' => 'teacher',
                'email' => 'teacher@gmail.com',
                'password' => Hash::make('teacher'),
            ]);
        }

        Teacher::factory()->count(5)->create();
    }
}
