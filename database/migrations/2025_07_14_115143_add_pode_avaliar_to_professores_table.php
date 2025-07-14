<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professores', function (Blueprint $table) {
            $table->boolean('pode_avaliar')->default(false)->after('siape');
        });
    }

    public function down(): void
    {
        Schema::table('professores', function (Blueprint $table) {
            $table->dropColumn('pode_avaliar');
        });
    }
};
