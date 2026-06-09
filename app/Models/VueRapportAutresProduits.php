<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VueRapportAutresProduits extends Model
{
    protected $table = 'vue_rapport_autres_produits';

    protected $primaryKey = 'idvisite';

    public $timestamps = true;

    protected $guarded = [];
}