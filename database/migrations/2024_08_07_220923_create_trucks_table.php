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
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('no_plate')->unique();
            $table->unsignedBigInteger('shipper_id'); // Foreign key for Shipper
            $table->timestamps();
            $table->softDeletes(); // Add soft delete column

            // Foreign key constraint
            $table->foreign('shipper_id')->references('id')->on('shippers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
