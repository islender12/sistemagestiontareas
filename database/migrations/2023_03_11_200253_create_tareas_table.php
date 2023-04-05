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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_asignacion');
            $table->date('fecha_vencimiento');
            $table->unsignedBigInteger('user_id')->comment('Usuario Creador de la Tarea');
            $table->unsignedBigInteger('proyecto_id')->comment('Proyecto al que Pertenece la Tarea');
            $table->string('estatus')->default('sin asignar');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->restrictOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
