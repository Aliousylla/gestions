<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Livraison;
use App\Models\Mouvement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Magasin extends Model
{
    use HasFactory;
    protected $fillable = ['nom_magasin','adresse_magasin', 'telephone_magasin','nom_responsable_magasin'];
        public function mouvements()
    {
        return $this->hasMany(Mouvement::class,'magasin_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'magasin_id');
    }
    public function client()
    {
        return $this->hasMany(Client::class,);
    }
    public function livraison()
    {
        return $this->hasMany(Livraison::class,);
    }
    public function produit()
    {
        return $this->hasMany(Produit::class, 'magasin_id');
    }
}
