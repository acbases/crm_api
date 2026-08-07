<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllproRh extends Model
{
    protected $connection = 'Allpro_rh';

    protected $table = 'rh';

    public $timestamps = false;

    protected $casts = [
        'statut_crm' => 'boolean',
    ];
}
