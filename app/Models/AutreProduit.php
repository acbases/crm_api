<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutreProduit extends Model
{
    protected $table = 'autre_produit';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idvisite',
        'nom',
        'prix_achat',
        'prix_vente_gros',
        'prix_vente_details',
        'cout_transport',
        'marge',
        'volume',
    ];

    protected $casts = [
        'prix_achat' => 'decimal:2',
        'prix_vente_gros' => 'decimal:2',
        'prix_vente_details' => 'decimal:2',
        'cout_transport' => 'decimal:2',
        'marge' => 'decimal:2',
        'volume' => 'decimal:2',
    ];

    /**
     * Relation with visite table
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }
}