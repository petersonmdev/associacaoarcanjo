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
        Schema::table('assisteds', function (Blueprint $table) {
            // Remove a constraint atual com cascade
            $table->dropForeign(['voluntary_id']);

            // Cria a nova constraint com set null
            $table->foreign('voluntary_id')
                  ->references('id')
                  ->on('voluntaries')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assisteds', function (Blueprint $table) {
            // Remove a constraint com set null
            $table->dropForeign(['voluntary_id']);

            // Volta para a constraint original com cascade
            $table->foreign('voluntary_id')
                  ->references('id')
                  ->on('voluntaries')
                  ->onDelete('cascade');
        });
    }
};
