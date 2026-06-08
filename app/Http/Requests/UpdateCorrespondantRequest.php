<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCorrespondantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['nullable', 'string'],
            'poste' => ['nullable', 'string'],
            'contact' => ['nullable', 'string'],
        ];
    }
}
