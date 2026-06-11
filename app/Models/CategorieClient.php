<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieClient extends Model
{
    protected $table = 'categorie_client';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'intitule',
        'statut'
    ];

    /**
     * Clients belonging to this category
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'idcategorie', 'id');
    }
}