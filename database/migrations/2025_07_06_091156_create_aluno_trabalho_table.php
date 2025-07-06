<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aluno_trabalho', function (Blueprint $table) {
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('user_id')->on('alunos')->onDelete('cascade');
            $table->foreignId('trabalho_id')->constrained('trabalhos')->onDelete('cascade');
            $table->primary(['aluno_id', 'trabalho_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aluno_trabalho');
    }
};
