<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVisite extends Model
{
    protected $table = 'type_visite';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];
}