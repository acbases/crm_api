<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idclient' => ['nullable', 'integer', 'min:1', 'exists:client,id'],
            'idutilisateur' => ['nullable', 'integer', 'min:1', 'exists:utilisateur,id'],
            'idcategorie' => ['nullable', 'integer', 'min:1', 'exists:categorie_visite,id'],
            'date' => ['nullable', 'date'],
            'statut' => ['required', 'integer', 'min:0',],
            'type' => ['nullable', 'integer', 'min:1',],
            'idtype' => ['nullable', 'integer', 'min:1', 'exists:type_visite,id'],
            'object' => ['nullable', 'string'],
        ];
    }
}
