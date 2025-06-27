<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'family_members' => 'nullable|integer',
            'age_group' => 'nullable|string',
            'preferred_activity' => 'nullable|string',
            'main_goal' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
        ];
    }
}
