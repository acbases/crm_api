<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $table = 'visite';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idclient',
        'idutilisateur',
        'idcategorie',
        'date',
        'statut',
        'type',
        'idtype',
        'object',
    ];

    /**
     * Client linked to this visite
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'idclient', 'id');
    }

    /**
     * Utilisateur linked to this visite
     */
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idutilisateur', 'id');
    }

    /**
     * Categorie visite linked to this visite
     */
    public function categorieVisite()
    {
        return $this->belongsTo(CategorieVisite::class, 'idcategorie', 'id');
    }

    /**
     * Type visite linked to this visite
     */
    public function typeVisite()
    {
        return $this->belongsTo(TypeVisite::class, 'idtype', 'id');
    }
}

