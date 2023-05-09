<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['produit_id', 'taille_id', 'couleur_id', 'usager_id','compagne_id', 'quantite', 'statut'];


    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }

    public function compagne()
    {
        return $this->belongsTo(Compagne::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function taille()
    {
        return $this->belongsTo(Taille::class);
    }
    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }
}
