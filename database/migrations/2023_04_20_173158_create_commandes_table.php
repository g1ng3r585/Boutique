<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produit_id');
            $table->unsignedBigInteger('taille_id');
            $table->unsignedBigInteger('couleur_id');
            $table->unsignedBigInteger('usager_id');
            $table->unsignedBigInteger('compagne_id');
            $table->integer('quantite');
            $table->string('statut', 256);
            
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->foreign('taille_id')->references('id')->on('tailles');
            $table->foreign('couleur_id')->references('id')->on('couleurs');
            $table->foreign('usager_id')->references('id')->on('usagers');
            $table->foreign('compagne_id')->references('id')->on('compagnes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
