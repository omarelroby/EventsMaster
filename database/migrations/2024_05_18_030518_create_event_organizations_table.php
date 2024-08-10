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
        Schema::create('event_organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('list_type_id'); // Assuming you have a ListType model
            $table->string('account_number')->nullable();
            $table->string('raranking')->nullable();
            $table->boolean('local_publishers_membership')->default(false);
            $table->string('publishing_license')->nullable();
            $table->integer('issues_quantity')->nullable();
            $table->integer('number_of_shipping')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('egent_id')->nullable();
            $table->text('revision')->nullable();
            $table->text('acceptability');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_organizations');
    }
};
