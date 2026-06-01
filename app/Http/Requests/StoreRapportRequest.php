<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRapportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idvisite' => ['required', 'integer', 'exists:visite,id'],
            'description' => ['nullable', 'string'],
            'autre_plv' => ['nullable', 'string'],
        ];
    }
}
