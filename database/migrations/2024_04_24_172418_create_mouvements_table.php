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
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->float('prix_vente')->default(0);
            $table->integer('quantite_piece_vendue')->default(0);
            $table->enum('type', ['entrant', 'sortant','static'])->default('static');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->foreignId('magasin_id')->constrained()->onDelete('cascade');
            $table->foreignId('commande_id')->nullable()->constrained();
            $table->foreignId('livraison_id')->nullable()->constrained();
            $table->foreignId('retour_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
