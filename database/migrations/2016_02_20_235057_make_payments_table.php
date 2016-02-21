<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('payments', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('physician_profile_id');
    		$table->string('teaching_hospital_name');
    		$table->string('physician_first_name');
    		$table->string('physician_middle_name');
    		$table->string('physician_last_name');
    		$table->string('recipient_primary_business_street_address_line1');
    		$table->string('recipient_primary_business_street_address_line2');
    		$table->string('recipient_city');
    		$table->string('recipient_state');
    		$table->string('recipient_zip_code');
    		$table->string('physician_primary_type');
    		$table->string('physician_specialty');
    		$table->string('applicable_manufacturer_or_applicable_gpo_making_payment_name');
    		$table->string('applicable_manufacturer_or_applicable_gpo_making_payment_state');
    		$table->decimal('total_amount_of_payment_usdollars',12,2);
    		$table->string('date_of_payment');
    		$table->string('form_of_payment_or_transfer_of_value');
    		$table->string('nature_of_payment_or_transfer_of_value');
    		$table->string('name_of_associated_covered_drug_or_biological1');
    		$table->string('name_of_associated_covered_drug_or_biological2');
    		$table->string('name_of_associated_covered_drug_or_biological3');
    		$table->string('name_of_associated_covered_drug_or_biological4');
    		$table->string('name_of_associated_covered_drug_or_biological5');
    		$table->string('name_of_associated_covered_device_or_medical_supply1');
    		$table->string('name_of_associated_covered_device_or_medical_supply2');
    		$table->string('name_of_associated_covered_device_or_medical_supply3');
    		$table->string('name_of_associated_covered_device_or_medical_supply4');
    		$table->string('name_of_associated_covered_device_or_medical_supply5');
    		$table->string('payment_publication_date');
    		$table->timestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('payments');
    }
}


