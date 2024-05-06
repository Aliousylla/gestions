<?php

namespace App\Models;

use App\Models\Magasin;
use App\Models\Categorie;
use App\Models\Mouvement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    // permet de définir les champs qui sont modifiable dans la BDD
    protected $fillable = [
        'libelle',	'reference',	'chemin',	'prix_achat',	'prix_vente',	'nombre_carton'	,'nombre_piece_carton'	,'categorie_id'	,'magasin_id'];
        // definir les relations

        public function categorie() 
            {
                 return $this->belongsTo(Categorie::class);
            }

        public function magasin() 
            {
                 return $this->belongsTo(Magasin::class);
            }

        public function mouvements()
            {
                return $this->hasMany(Mouvement::class,'produit_id');
            }
            public function prixVente()
{
    // Implémentez la logique pour récupérer le prix de vente du produit
    // Si le prix de vente est stocké dans une relation, par exemple
    return $this->prixVentes->last()->prix_vente;
}

            public static function boot()
        {
            parent::boot();
                static::creating(function ($produit) {
                    $prefix = 'PR'; // Vous pouvez personnaliser le préfixe
                    $randomPart = strtoupper(Str::random(6));
                    $code_produit = $prefix . $randomPart;
            
                    // Vérification de l'unicité du code produit
                    while (produit::where('code_produit', $code_produit)->exists()) {
                        $randomPart = strtoupper(Str::random(6));
                        $code_produit = $prefix . $randomPart;
                    }
            
                    $produit->code_produit = $code_produit;
                });
        }
        
        

        
}
