<?php

namespace App\Models;

use App\Models\Magasin;
use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [ 'nom_client','adresse_client','telephone_client','email_client','plafond_client','code_client','magasin_id'];
    public function livraisons()
        {
        return $this->hasMany(Livraison::class);
        }
        
    public function commandes()
        {
         return $this->hasMany(Commande::class);
        }
    
    public function magasin()
        {
        return $this->belongsTo(Magasin::class);
        }

     public static function boot()
        {
            parent::boot();
                static::creating(function ($client) {
                    $prefix = 'DI'; // Vous pouvez personnaliser le préfixe
                    $randomPart = strtoupper(Str::random(6));
                    $code_client = $prefix . $randomPart;
            
                    // Vérification de l'unicité du code client
                    while (Client::where('code_client', $code_client)->exists()) {
                        $randomPart = strtoupper(Str::random(6));
                        $code_client = $prefix . $randomPart;
                    }
            
                    $client->code_client = $code_client;
                });
        }
}
