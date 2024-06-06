<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $this->user->id,
            'password' => 'sometimes|required|string|min:8',
            'last_login' => 'nullable|date',
            'is_active' => 'sometimes|required|boolean',
            'role' => 'sometimes|required|in:manager,agent',
        ];
    }
}
