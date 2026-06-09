<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitClient extends Model
{
    protected $table = 'produit_client';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'idclient',
        'idproduit',
    ];

    /**
     * The client this pivot record belongs to
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'idclient', 'id');
    }

    /**
     * The produit this pivot record belongs to
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idproduit', 'id');
    }

    /**
     * Reference prices associated with this product-client assignment
     */
    public function refPrixProduits()
    {
        return $this->hasMany(RefPrixProduit::class, 'idproduit', 'id');
    }
}