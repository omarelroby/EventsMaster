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

        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity'); // Invoice Date and Time
            $table->unsignedBigInteger('invoice_id'); // FK to Organization table (Company with the invoice)
            $table->unsignedBigInteger('item_id'); // FK to Event table

            // Foreign Key Constraints
            $table->foreign('invoice_id')->references('id')->on('invoices');

            $table->softDeletes(); // Add the soft delete column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
