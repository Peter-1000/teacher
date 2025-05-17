<?php

namespace App\Http\Requests\Auth;

use App\Dto\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $email
 */
class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.exists' => 'No admin account found with this email',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ];
    }

    public function getDto(): LoginDto
    {
        $dto = new LoginDto();
        $dto->setEmail($this->email);
        $dto->setPassword($this->password);
        return $dto;
    }
}
