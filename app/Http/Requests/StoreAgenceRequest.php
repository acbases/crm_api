<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'intitule' => ['nullable', 'string', 'max:50'],
            'region' => ['nullable', 'string', 'max:50'],
        ];
    }
}