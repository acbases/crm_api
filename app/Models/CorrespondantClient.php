<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorrespondantClient extends Model
{
    protected $table = 'correspondant_client';
    public $timestamps = false;

    protected $fillable = ['idclient', 'idcorrespondant'];
}