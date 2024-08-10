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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('abbreviation')->nullable();
            $table->string('name_tag')->nullable();
            $table->string('zip')->nullable();
            $table->string('email')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('president')->nullable();
            $table->date('start_date');
            $table->date('registration_start_date')->nullable();
            $table->date('registration_end_date')->nullable();
            $table->date('event_end_date')->nullable();
            $table->date('public_event_start_date')->nullable();
            $table->date('shipping_start_date')->nullable();
            $table->string('street_adress')->nullable();
            $table->text('map_location')->nullable();
            $table->unsignedBigInteger('event_specialty_id')->nullable();
            $table->unsignedBigInteger('event_series_id')->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->decimal('map_lat', 10, 7)->nullable();
            $table->decimal('map_lng', 10, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
