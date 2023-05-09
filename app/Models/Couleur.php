<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    use HasFactory;
    protected $fillable = ['couleur', 'hex'];


    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }

}
