<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRapportB2BRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idvisite' => ['required', 'integer', 'min:1', 'exists:visite,id'],
            'description' => ['nullable', 'string'],
            'action_a_faire' => ['nullable', 'string'],
            'prochaine_visite' => ['nullable', 'date'],
            'idcorrespondant' => ['nullable', 'integer', 'exists:correspondant,id'],
            'sary' => ['required', 'file', 'max:10240'],
        ];
    }
}
