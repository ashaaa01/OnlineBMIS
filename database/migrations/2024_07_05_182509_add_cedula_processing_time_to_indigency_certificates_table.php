<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCedulaProcessingTimeToIndigencyCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indigency_certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('issuance_configuration_id')->nullable()->after('some_existing_column'); // Replace 'some_existing_column' with the appropriate column name
            $table->decimal('total_amount_paid', 8, 2)->nullable()->after('issuance_configuration_id');
            $table->string('cedula_processing_time')->nullable()->after('total_amount_paid');
            
            // Add foreign key constraint if required
            $table->foreign('issuance_configuration_id')
                  ->references('id')
                  ->on('issuance_configurations')
                  ->onDelete('cascade'); // Adjust as necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indigency_certificates', function (Blueprint $table) {
            $table->dropForeign(['issuance_configuration_id']);
            $table->dropColumn('issuance_configuration_id');
            $table->dropColumn('total_amount_paid');
            $table->dropColumn('cedula_processing_time');
        });
    }
}

