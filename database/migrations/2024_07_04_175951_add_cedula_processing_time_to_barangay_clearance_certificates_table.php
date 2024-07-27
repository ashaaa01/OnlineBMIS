<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCedulaProcessingTimeToBarangayClearanceCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangay_clearance_certificates', function (Blueprint $table) {
            $table->string('cedula_processing_time')->after('total_amount_paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangay_clearance_certificates', function (Blueprint $table) {
            $table->dropColumn('cedula_processing_time');
        });
    }
}
