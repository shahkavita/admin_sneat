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
        Schema::create('tbl_city', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->unsignedBigInteger('state_id'); // Foreign key column
            // Foreign key constraint
            $table->foreign('state_id')->references('id')->on('tbl_state')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_city');
    }
};
