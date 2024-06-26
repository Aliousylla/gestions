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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code_produit')->unique();
            $table->string('libelle');
            $table->string('reference');
            $table->string('chemin');
            $table->float('prix_achat')->default(0);
            $table->float('prix_vente')->default(0);
            $table->integer('nombre_carton')->default(0);
            $table->integer('nombre_piece_carton')->default(0);
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->foreignId('magasin_id')->constrained()->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
