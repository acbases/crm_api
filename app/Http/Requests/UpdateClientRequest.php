<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'zone' => ['nullable', 'string'],
            'quartier' => ['nullable', 'string'],
            'idagence' => ['nullable', 'integer'],
            'idcategorie' => ['nullable', 'integer'],
            'status_qrcode' => ['nullable', 'boolean'],
        ];
    }
}
