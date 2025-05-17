<?php

namespace App\Http\Requests\Teacher;

use App\Dto\SaveClassScheduleDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $subject_id
 * @property string $start_time
 * @property string $end_time
 */
class TeacherSaveClassScheduleRequest extends FormRequest
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
            'subject_id' => 'required|integer|exists:subjects,id',
            'start_time' => 'required|date|date_format:Y-m-d H:i|after_or_equal:now',
            'end_time' => 'required|date|date_format:Y-m-d H:i|after:start_time',
        ];
    }

    public function getDto(): SaveClassScheduleDto
    {
        $dto = new SaveClassScheduleDto();
        $dto->setTeacherId($this->user()->id);
        $dto->setSubjectId($this->subject_id);
        $dto->setStartedAt($this->start_time);
        $dto->setEndedAt($this->end_time);

        return $dto;
    }
}
