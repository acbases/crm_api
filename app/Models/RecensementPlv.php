<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecensementPlv extends Model
{
    protected $table = 'recensement_plv';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idvisite',
        'idplv',
    ];

    /**
     * The visite this recensement record belongs to
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }

    /**
     * The PLV item this recensement record belongs to
     */
    public function plv()
    {
        return $this->belongsTo(Plv::class, 'idplv', 'id');
    }
}