<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'English',
            'History',
            'Geography',
            'Computer Science',
            'Art',
            'Physical Education'
        ];

        foreach ($subjects as $name) {
            Subject::query()->firstOrCreate(['name' => $name]);
        }
    }
}
