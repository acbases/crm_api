<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'zone' => ['nullable', 'string', 'max:255'],
            'quartier' => ['nullable', 'string', 'max:255'],
            'idagence' => ['nullable', 'integer', 'min:1'],
            'idcategorie' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
