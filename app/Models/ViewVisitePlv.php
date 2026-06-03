<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewVisitePlv extends Model
{
    protected $table = 'v_visite_plv';

    protected $primaryKey = 'id_visite';

    public $timestamps = false;

    protected $guarded = [];
}