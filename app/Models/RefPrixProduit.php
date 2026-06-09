<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefPrixProduit extends Model
{
    protected $table = 'ref_prix_produit';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'idvisite',
        'idproduit',
        'prix_achat',
        'prix_vente_gros',
        'prix_vente_details',
        'cout_transport',
        'marge',
        'volume',
    ];

    /**
     * The product-client relationship assignment this price belongs to
     */
    public function produitClient()
    {
        return $this->belongsTo(ProduitClient::class, 'idproduit', 'id');
    }

    /**
     * The visite this price belongs to
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }
}