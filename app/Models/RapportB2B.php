<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RapportB2B extends Model
{
    protected $table = 'rapportb2b';

    protected $primaryKey = 'id';

    public $timestamps = true;

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
     * Expose the stored file path as a full public URL.
     */
    public function getSaryAttribute($value)
    {
        if (! $value) {
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

    /**
     * Relation with correspondant table
     */
    public function correspondant()
    {
        return $this->belongsTo(Correspondant::class, 'idcorrespondant', 'id');
    }
}
