<?php

namespace App\Models;

use App\Models\Retour;
use App\Models\Magasin;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mouvement extends Model
{
    use HasFactory;
    protected $fillable = ['prix_vente', 'quantite_piece_vendue', 'type' ,'produit_id','magasin_id','commande_id','livraison_id','retour_id'];

// Relation "belongsTo" avec le modèle produit
    public function produit()
    {
        return $this->belongsTo(Produit::class,'produit_id');
    }

    // Relation "belongsTo" avec le modèle magasin
    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id');
    }

    // Relation "belongsTo" avec le modèle livraison
    
    public function livraison()
    {
        return $this->belongsTo(Livraison::class, 'livraison_id');
    }
// Relation "belongsTo" avec le modèle commande
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
    // Relation "belongsTo" avec le modèle retour
    public function retour()
    {
        return $this->belongsTo(Retour::class, 'retour_id');
    }
}
