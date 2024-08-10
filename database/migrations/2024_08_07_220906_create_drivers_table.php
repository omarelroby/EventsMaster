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
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->string('tag_name')->nullable();
            $table->string('type_id');
            $table->date('date_birth');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('shipper_id'); // Foreign key for Shipper
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('shipper_id')->references('id')->on('shippers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
