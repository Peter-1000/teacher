<?php

namespace App\Http\Requests\Admin;

use App\Dto\SaveClassScheduleDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $teacher_id
 * @property int $subject_id
 * @property string $start_time
 * @property string $end_time
 */
class AdminSaveClassScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'teacher_id' => 'required|integer|exists:teachers,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'start_time' => 'required|date|date_format:Y-m-d H:i',
            'end_time' => 'required|date|date_format:Y-m-d H:i',
        ];
    }

    public function getDto(): SaveClassScheduleDto
    {
        $dto = new SaveClassScheduleDto();
        $dto->setTeacherId($this->teacher_id);
        $dto->setSubjectId($this->subject_id);
        $dto->setStartedAt($this->start_time);
        $dto->setEndedAt($this->end_time);

        return $dto;
    }
}
