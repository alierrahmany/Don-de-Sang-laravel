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
        Schema::create('assignations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receveur_id')->constrained()->onDelete('cascade');
            $table->foreignId('donneur_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_assignation');
            $table->string('statut')->default('assigné');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['receveur_id', 'donneur_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignations');
    }
};
