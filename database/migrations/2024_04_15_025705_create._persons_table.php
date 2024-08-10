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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('surName');
            $table->string('name_tag');
            $table->string('card_id');
            $table->string('id_type');
            $table->string('id_expiration');
            $table->string('Honor');
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->boolean('gender');
            $table->string('zip');
            $table->string('Phone1');
            $table->string('WhatsApp');
            $table->string('Personal_Photo');
            $table->string('street_address');
            $table->string('linkedIn');
            $table->string('Job_title');
            $table->string('cv');

            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->string('leader_Sn');
            $table->string('account_number');

            $table->boolean('active')->default(0);
            $table->rememberToken();
            $table->text('api_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
