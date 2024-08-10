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
        Schema::create('manifest', function (Blueprint $table) {
            $table->id();
            $table->string('manifest_number')->unique();
            $table->date('date_receiving_shipment');
            $table->integer('quantity');
            $table->string('number_clearance_customs')->nullable();
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('truck_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('list_type_id');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('shipper_id')->references('id')->on('shippers');
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('list_type_id')->references('id')->on('listed_types'); // Assuming you have a 'type_listes' table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifest');
    }
};
