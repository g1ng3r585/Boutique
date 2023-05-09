<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'titre', 'prix', 'caracteristiques'];
    public function tailles()
    {
        return $this->belongsToMany(Taille::class);
    }
    public function couleurs()
    {
        return $this->belongsToMany(Couleur::class);
    }
    public function compagnes()
    {
        return $this->belongsToMany(Compagne::class);
    }
    public function commande()
    {
        return $this->belongsToMany(Commande::class);
    }

}
