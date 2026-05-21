<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'latitude',
        'longitude',
        'zone',
        'quartier',
        'idagence',
        'idcategorie',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Relation with agence table
     */
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'idagence', 'id');
    }

    /**
     * Relation with categorie_client table
     */
    public function categorie()
    {
        return $this->belongsTo(CategorieClient::class, 'idcategorie', 'id');
    }
}
