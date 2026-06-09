<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieVisite extends Model
{
    protected $table = 'categorie_visite';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'intitule',
    ];
}