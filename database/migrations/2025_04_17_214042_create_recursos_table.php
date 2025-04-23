<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', '100');
            $table->string('tipo de recurso', '30');
            $table->string('descipcion', '200');
            $table->string('formato', '20');
            $table->string('ubicacion', '20');
            $table->date('fecha de publicacion');
            $table->boolean('estado');
            $table->string('responsable', '30');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
