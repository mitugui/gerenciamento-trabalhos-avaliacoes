<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabalho_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('professor_id');
            $table->foreign('professor_id')->references('user_id')->on('professores')->onDelete('cascade');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->text('comentario')->nullable();
            $table->decimal('nota', 5, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
