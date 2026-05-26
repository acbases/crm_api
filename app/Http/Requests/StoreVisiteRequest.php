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
            'idclient' => ['required', 'integer', 'min:1', 'exists:client,id'],
            'idutilisateur' => ['required', 'integer', 'min:1', 'exists:utilisateur,id'],
            'idcategorie' => ['required', 'integer', 'min:1', 'exists:categorie_visite,id'],
            'date' => ['required', 'date'],
            'statut' => ['nullable', 'integer', 'min:1',],
            'type' => ['nullable', 'integer', 'min:1',],
            'idtype' => ['nullable', 'integer', 'min:1', 'exists:type_visite,id'],
            'object' => ['nullable', 'string'],
        ];
    }
}
