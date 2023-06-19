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
        Schema::table('rows', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('name');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rows', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->string('name');
            $table->timestamp('date');
            $table->dropTimestamps();
        });
    }
};
