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
        Schema::create('tbl_state', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->unsignedBigInteger('country_id'); // Foreign key column
            // Foreign key constraint
            $table->foreign('country_id')->references('id')->on('tbl_country')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state');
    }
};
