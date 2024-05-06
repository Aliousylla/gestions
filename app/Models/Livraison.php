<?php

namespace App\Models;

use App\Models\Avance;
use App\Models\Client;
use App\Models\Magasin;
use App\Models\Commande;
use App\Models\Mouvement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','magasin_id','commande_id','type','date_livraison'];
    public function client() 
    {
    return $this->belongsTo(Client::class);
    }
    public function magasin() 
    {
    return $this->belongsTo(Magasin::class);
    }
    
       
     public function mouvements()
    {
    return $this->belongsTo(Mouvement::class, 'mouvement_id');
    }
    

    public function avances()
    {
    return $this->hasMany(Avance::class);
    }

        public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
    public static function boot()
    {
        parent::boot();
            static::creating(function ($livraison) {
                $prefix = 'LI'; // Vous pouvez personnaliser le préfixe
                $randomPart = strtoupper(Str::random(6));
                $numero_livraison = $prefix . $randomPart;
        
                // Vérification de l'unicité du code client
                while (Livraison::where('numero_livraison', $numero_livraison)->exists()) {
                    $randomPart = strtoupper(Str::random(6));
                    $numero_livraison = $prefix . $randomPart;
                }
        
                $livraison->numero_livraison = $numero_livraison;
            });
    }
}
