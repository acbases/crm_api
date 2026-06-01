<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecensementPlvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idvisite' => ['required', 'integer', 'exists:visite,id'],
            'idplv' => ['required', 'integer', 'exists:plv,id'],
        ];
    }
}
