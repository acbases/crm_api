<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutreProduitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idvisite' => ['required', 'integer', 'min:1'],
            'nom' => ['required', 'string', 'max:100'],

            'prix_achat' => ['nullable', 'numeric'],
            'prix_vente_gros' => ['nullable', 'numeric'],
            'prix_vente_details' => ['nullable', 'numeric'],
            'cout_transport' => ['nullable', 'numeric'],
            'marge' => ['nullable', 'numeric'],
            'volume' => ['nullable', 'numeric'],
        ];
    }
}