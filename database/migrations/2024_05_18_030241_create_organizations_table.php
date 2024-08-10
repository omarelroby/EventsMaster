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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name')->nullable();
            $table->text('organization_Sn')->nullable();
            $table->text('commercial_Name')->nullable();
            $table->text('name_tag')->nullable();
            $table->text('commercial_rgistryID')->nullable();
            $table->dateTime('commercial_registry_expiration')->nullable();

            $table->string('Phone1')->nullable();
            $table->string('Phone2')->nullable();
            $table->string('WhatsApp')->nullable();
            $table->string('head_office_address')->nullable();
            $table->string('website')->nullable();
            $table->string('zip')->nullable();
            $table->string('email')->nullable();


            $table->string('commercial_registry_file')->nullable();
            $table->string('tax_registryID')->nullable();
            $table->datetime('tax_registry_expiration')->nullable();
            $table->datetime('establish_date')->nullable();


            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban')->nullable();

            $table->integer('city_id')->nullable();
            $table->integer('nationality_country_Id')->nullable();
            $table->integer('org_classification_id')->nullable();
            $table->integer('legal_form_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->string('organization_parent_Sn')->nullable();
           
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
