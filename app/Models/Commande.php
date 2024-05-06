<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Livraison;
use App\Models\Mouvement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['numero_commande','client_id','magasin_id','libelle','etat','date_commande'];
    public function client() {
           return $this->belongsTo(Client::class);
       }
       public function livraison()
       {
          return $this->belongsTo(Livraison::class, 'livraison_id');
      }
      public function mouvements()
      {
      return $this->belongsTo(Mouvement::class, 'mouvement_id');
      }
}
