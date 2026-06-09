<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateur';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'mail',
        'password',
        'statut',
    ];
}