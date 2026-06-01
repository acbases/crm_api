<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'intitule',
        'statut',
    ];

    /**
     * Clients associated with this produit
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'produit_client', 'idproduit', 'idclient')
                    ->withPivot('id');
    }
}