<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropColumn('comentario');
            $table->text('descricao')->nullable()->after('professor_id');
        });
    }

    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropColumn('descricao');
            $table->text('comentario')->nullable()->after('professor_id');
        });
    }
};
