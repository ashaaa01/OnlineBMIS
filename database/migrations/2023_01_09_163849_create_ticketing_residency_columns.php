<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingResidencyColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residency_certificates', function (Blueprint $table) {
            $table->string('total_amount_paid')->nullable();
            $table->string('ticket_datetime')->nullable();
            $table->string('ticket_number')->nullable();
            $table->unsignedBigInteger('issuance_configuration_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residency_certificates', function (Blueprint $table) {
            //
        });
    }
}
