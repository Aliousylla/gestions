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
        Schema::create('retours', function (Blueprint $table) {
            $table->id();
            $table->string('numero_retour')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('magasin_id')->constrained()->onDelete('cascade');
            $table->string('libelle');
            $table->foreignId('livraison_id')->constrained();
            $table->timestamp('date_retour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retours');
    }
};
