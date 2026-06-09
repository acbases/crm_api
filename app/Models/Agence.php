<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $table = 'agence';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'intitule',
        'region',
    ];

    /**
     * Clients belonging to this agence
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'idagence', 'id');
    }
}