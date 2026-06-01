<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $table = 'rapport';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idvisite',
        'description',
        'autre_plv',
    ];

    /**
     * Relation with visite table
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }
}