<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plv extends Model
{
    protected $table = 'plv';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    /**
     * Visites associated with this PLV
     */
    public function visites()
    {
        return $this->belongsToMany(Visite::class, 'recensement_plv', 'idplv', 'idvisite')
                    ->withPivot('id');
    }
}