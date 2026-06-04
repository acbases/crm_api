<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VueRapportProduits extends Model
{
    protected $table = 'vue_rapport_produits';

    protected $primaryKey = 'idvisite';

    public $timestamps = false;

    protected $guarded = [];
}