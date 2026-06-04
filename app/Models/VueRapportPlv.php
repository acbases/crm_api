<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VueRapportPlv extends Model
{
    protected $table = 'vue_rapport_plv';

    protected $primaryKey = 'idvisite';

    public $timestamps = false;

    protected $guarded = [];
}