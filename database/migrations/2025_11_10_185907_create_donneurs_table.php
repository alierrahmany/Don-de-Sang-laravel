<?php
// database/migrations/2024_01_01_000000_create_donneurs_table.php

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
        Schema::create('donneurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->enum('groupe_sanguin', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('ville');
            $table->date('date_naissance');
            $table->enum('genre', ['Homme', 'Femme']);
            $table->date('dernier_don')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
            
            // Index pour améliorer les performances
            $table->index('groupe_sanguin');
            $table->index('ville');
            $table->index('disponible');
            $table->index('dernier_don');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donneurs');
    }
};