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
        Schema::create('interest_person', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('interest_id')->unsigned();
			$table->bigInteger('person_id')->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_people');
    }
};
