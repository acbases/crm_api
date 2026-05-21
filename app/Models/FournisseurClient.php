<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FournisseurClient extends Model
{
    protected $table = 'fournisseur_client';
    public $timestamps = false;

    protected $fillable = ['idfournisseur', 'idclient'];
}