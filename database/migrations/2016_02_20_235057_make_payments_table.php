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
	    		$table->integer('record_id');
	    		$table->integer('physician_profile_id');
	    		$table->string('teaching_hospital_name');
	    		$table->string('physician_first_name',50);
	    		$table->string('physician_middle_name',50);
	    		$table->string('physician_last_name',50);
	    		$table->string('recipient_primary_business_street_address_line1',100);
	    		$table->string('recipient_primary_business_street_address_line2',100);
	    		$table->string('recipient_city',20);
	    		$table->string('recipient_state',20);
	    		$table->string('recipient_zip_code',10);
	    		$table->string('physician_primary_type',50);
	    		$table->string('physician_specialty');
	    		$table->string('applicable_manufacturer_or_applicable_gpo_making_payment_name', 100);
	    		$table->string('applicable_manufacturer_or_applicable_gpo_making_payment_state',20);
	    		$table->longText("contextual_information");
	    		$table->decimal('total_amount_of_payment_usdollars',12,2);
	    		$table->string('date_of_payment');
	    		$table->string('form_of_payment_or_transfer_of_value', 100);
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
	    		
	    		$table->primary('record_id');
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


