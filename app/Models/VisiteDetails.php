<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiteDetails extends Model
{
    protected $table = 'v_visite_details';

    protected $primaryKey = 'id_visite';

    public $timestamps = false;

    protected $guarded = [];
}