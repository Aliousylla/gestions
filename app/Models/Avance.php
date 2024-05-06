<?php

namespace App\Models;

use App\Models\Livraison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avance extends Model
{
    use HasFactory;
    protected $fillable = ['livraison_id','montant_debit','montant_credit','date_avance','details'];
    

    public function livraison()
    {
        return $this->belongsTo(Livraison::class);
    }
}
