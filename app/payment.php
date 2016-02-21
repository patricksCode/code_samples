<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
	protected $table = 'payments';
	
	protected $primaryKey = "record_id";
	
	protected $incrementing ="false";
	
	protected $record_id;
	
	protected $physician_profile_id;
	
	protected $teaching_hospital_name;
	
	protected $physician_first_name;
	
	protected $physician_middle_name;
	
	protected $physician_last_name;
	
	protected $recipient_primary_business_street_address_line1;
	
	protected $recipient_primary_business_street_address_line2;
	
	protected $recipient_city;
	
	protected $recipient_state;
	
	protected $recipient_zip_code;
	
	protected $physician_primary_type;
	
	protected $physician_specialty;
	
	protected $applicable_manufacturer_or_applicable_gpo_making_payment_name;
	
	protected $applicable_manufacturer_or_applicable_gpo_making_payment_state;
	
	protected $total_amount_of_payment_usdollars;
	
	protected $date_of_payment;
	
	protected $form_of_payment_or_transfer_of_value;
	
	protected $nature_of_payment_or_transfer_of_value;
	
	protected $contextual_information;
	
	protected $name_of_associated_covered_drug_or_biological1;
	
	protected $name_of_associated_covered_drug_or_biological2;
	
	protected $name_of_associated_covered_drug_or_biological3;
	
	protected $name_of_associated_covered_drug_or_biological4;
	
	protected $name_of_associated_covered_drug_or_biological5;
	
	protected $name_of_associated_covered_device_or_medical_supply1;
	
	protected $name_of_associated_covered_device_or_medical_supply2;
	
	protected $name_of_associated_covered_device_or_medical_supply3;
	
	protected $name_of_associated_covered_device_or_medical_supply4;
	
	protected $name_of_associated_covered_device_or_medical_supply5;
	
	protected $payment_publication_date;
}
