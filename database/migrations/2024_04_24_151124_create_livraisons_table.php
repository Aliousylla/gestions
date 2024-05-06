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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('numero_livraison')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('magasin_id')->constrained()->onDelete('cascade');
            $table->foreignId('commande_id')->nullable()->constrained();
            $table->enum('type', ['Débit', 'Crédit'])->default('Débit');
            $table->timestamp('date_livraison');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
