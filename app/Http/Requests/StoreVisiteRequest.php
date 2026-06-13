<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idclient' => ['required', 'integer', 'exists:client,id'],
            'idutilisateur' => ['required', 'integer', 'exists:users,id'],
            'idcategorie' => ['required', 'integer', 'exists:categorie_visite,id'],
            'date' => ['required', 'date'],
            'statut' => ['nullable', 'integer',],
            'type' => ['nullable', 'integer',],
            'idtype' => ['nullable', 'integer', 'exists:type_visite,id'],
            'object' => ['nullable', 'string'],
        ];
    }
}
