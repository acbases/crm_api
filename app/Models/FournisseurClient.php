<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FournisseurClient extends Model
{
    protected $table = 'fournisseur_client';
    public $timestamps = true;

    protected $fillable = ['idfournisseur', 'idclient'];
    public function client()
    {
        return $this->belongsTo(Client::class, 'idclient', 'id');
    }
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idfournisseur', 'id');
    }

}