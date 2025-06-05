<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalProfileRequest extends FormRequest

{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'age' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'family_members' => 'nullable|integer',
            'preferred_activity' => 'nullable|string',
        ];
    }

    public function validationData()
    {
        return $this->all();
    }
}

