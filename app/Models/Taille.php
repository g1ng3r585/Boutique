<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taille extends Model
{
    use HasFactory;
    protected $fillable = ['taille'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }
}
