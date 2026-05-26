<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportB2B extends Model
{
    protected $table = 'rapportb2b';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idvisite',
        'description',
        'action_a_faire',
        'sary',
        'prochaine_visite',
        'idcorrespondant',
    ];

    protected $casts = [
        'prochaine_visite' => 'date',
    ];

    /**
     * Relation with visite table
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }

    /**
     * Relation with correspondant table
     */
    public function correspondant()
    {
        return $this->belongsTo(Correspondant::class, 'idcorrespondant', 'id');
    }
}