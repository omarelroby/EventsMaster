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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Invoice ID from the displaying company
            $table->dateTime('date_Invoice'); // Invoice Date and Time
            $table->unsignedBigInteger('organization_id'); // FK to Organization table (Company with the invoice)
            $table->unsignedBigInteger('event_id'); // FK to Event table
            $table->unsignedBigInteger('list_type_id'); // FK to Type of Subscription table

            // Foreign Key Constraints
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('list_type_id')->references('id')->on('listed_types');

            $table->softDeletes(); // Add the soft delete column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
