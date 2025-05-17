<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSchedule;
use App\Models\Teacher;
use App\Models\Subject;
use Carbon\Carbon;

class ClassScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();

        if ($teachers->count() === 0 || $subjects->count() === 0) {
            $this->command->warn('Please seed teachers and subjects first.');
            return;
        }

        foreach (range(1, 10) as $i) {
            $teacher = $teachers->random();
            $subject = $subjects->random();

            $start = Carbon::now()->addDays(rand(0, 5))->setTime(rand(8, 14), 0);
            $end = (clone $start)->addMinutes(90);

            ClassSchedule::query()->firstOrCreate([
                'teacher_id' => $teacher->id,
                'subject_id' => $subject->id,
                'start_time' => $start,
                'end_time' => $end,
            ]);
        }
    }
}
