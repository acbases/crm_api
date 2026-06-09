<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fournisseur extends Model
{
    protected $table = 'fournisseur';
    public $timestamps = true;

    protected $fillable = ['nom'];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'fournisseur_client', 'idfournisseur', 'idclient');
    }
}