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
        Schema::create('compagnes', function (Blueprint $table) {
            $table->id();

            
            $table->string('dateDebut', 255);
            $table->string('dateFin', 255);

            $table->string('debutPaiement', 255);
            $table->string('finPaiement', 255);

            $table->string('debutDistribution', 255);
            $table->string('finDistribution', 255);

            $table->string('statutCompagne', 255);
            $table->string('statutCommande', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagnes');
    }
};
