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
        Schema::create('tareas_asignadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_asignado_id');
            $table->unsignedBigInteger('tarea_id');
            $table->string('subtarea');
            $table->date('fecha_vencimiento');
            $table->string('status')->default('pendiente');
            $table->foreign('usuario_asignado_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('tarea_id')->references('id')->on('tareas')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas_asignadas');
    }
};
