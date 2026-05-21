<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Correspondant extends Model
{
    protected $table = 'correspondant';
    public $timestamps = false;

    protected $fillable = ['nom', 'poste', 'contact'];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'correspondant_client', 'idcorrespondant', 'idclient');
    }
}