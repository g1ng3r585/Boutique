<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagne extends Model
{
    use HasFactory;
    protected $fillable = ['dateDebut', 'dateFin', 'debutPaiement', 'finPaiement', 'debutDistribution', 'finDistribution', 'statutCompagne', 'statutCommande'];
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'compagne_produit');
    }
    
    
}
