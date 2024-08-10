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
        Schema::create('event_items', function (Blueprint $table) {
            $table->string('title');
            $table->text('content_summary');
            $table->string('content_copy_file')->nullable();
            $table->unsignedBigInteger('auther_id');
            $table->text('review')->nullable();
            $table->enum('acceptability', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->integer('number_of_copies')->nullable();
            $table->string('ISBN_number')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('organization_discount', 8, 2)->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('event_id');
            $table->softDeletes();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_items');
    }
};
