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
        Schema::create('org_legal_forms', function (Blueprint $table) {
            $table->id();
            $table->string('legal_form_code');
            $table->string('legal_form_abv');
            $table->string('legal_form_spc');
            $table->string('legal_form_sn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_legal_forms');
    }
};
