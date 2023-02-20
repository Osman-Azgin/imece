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
        Schema::create('imeces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->foreignId('requirement_id')->index();
            $table->foreignId('warehouse_id')->index()->nullable();
            $table->date('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imeces');
    }
};
