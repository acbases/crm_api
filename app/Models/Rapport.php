<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Rapport extends Model
{
    protected $table = 'rapport';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'idvisite',
        'description',
        'autre_plv',
        'sary'
    ];
    public function getSaryAttribute($value)
    {
        if (!$value) {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        return Storage::disk('public')->url($value);
    }
    /**
     * Relation with visite table
     */
    public function visite()
    {
        return $this->belongsTo(Visite::class, 'idvisite', 'id');
    }
}
