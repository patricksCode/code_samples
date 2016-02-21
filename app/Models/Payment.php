<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payments';
	
	public $incrementing ="false";
	
	public $primaryKey = "record_id";
	
	private $record_id;
	
	private $physician_profile_id;
	
	private $teaching_hospital_name;
	
	private $physician_first_name;
	
	private $physician_middle_name;
	
	private $physician_last_name;
	
	private $recipient_primary_business_street_address_line1;
	
	private $recipient_primary_business_street_address_line2;
	
	private $recipient_city;
	
	private $recipient_state;
	
	private $recipient_zip_code;
	
	private $physician_primary_type;
	
	private $physician_specialty;
	
	private $applicable_manufacturer_or_applicable_gpo_making_payment_name;
	
	private $applicable_manufacturer_or_applicable_gpo_making_payment_state;
	
	private $total_amount_of_payment_usdollars;
	
	private $date_of_payment;
	
	private $form_of_payment_or_transfer_of_value;
	
	private $nature_of_payment_or_transfer_of_value;
	
	private $contextual_information;
	
	private $name_of_associated_covered_drug_or_biological1;
	
	private $name_of_associated_covered_drug_or_biological2;
	
	private $name_of_associated_covered_drug_or_biological3;
	
	private $name_of_associated_covered_drug_or_biological4;
	
	private $name_of_associated_covered_drug_or_biological5;
	
	private $name_of_associated_covered_device_or_medical_supply1;
	
	private $name_of_associated_covered_device_or_medical_supply2;
	
	private $name_of_associated_covered_device_or_medical_supply3;
	
	private $name_of_associated_covered_device_or_medical_supply4;
	
	private $name_of_associated_covered_device_or_medical_supply5;
	
	private $payment_publication_date;
	
	
	protected $fillable =  ['record_id', 'physician_profile_id', 'teaching_hospital_name', 'physician_first_name', 
			'physician_middle_name', 'physician_last_name', 'recipient_primary_business_street_address_line1', 
			'recipient_primary_business_street_address_line2', 'recipient_city', 'recipient_state', 'recipient_zip_code', 
			'physician_primary_type', 'physician_specialty', 'applicable_manufacturer_or_applicable_gpo_making_payment_name', 
			'applicable_manufacturer_or_applicable_gpo_making_payment_state', 'contextual_information', 
			'total_amount_of_payment_usdollars', 'date_of_payment', 'form_of_payment_or_transfer_of_value', 
			'nature_of_payment_or_transfer_of_value', 'name_of_associated_covered_drug_or_biological1', 
			'name_of_associated_covered_drug_or_biological2', 'name_of_associated_covered_drug_or_biological3', 
			'name_of_associated_covered_drug_or_biological4', 'name_of_associated_covered_drug_or_biological5', 
			'name_of_associated_covered_device_or_medical_supply1', 'name_of_associated_covered_device_or_medical_supply2', 
			'name_of_associated_covered_device_or_medical_supply3', 'name_of_associated_covered_device_or_medical_supply4', 
			'name_of_associated_covered_device_or_medical_supply5', 'payment_publication_date'];
	
	
	
	
	
	
	
	public function __set($name, $value)
	{
		if(isset($this->attributes[$name])){
			$this->attributes[$name] = $value;				
		}
		
		return $this;
	}
	
	public function __get($name)
	{
		if(isset($this->attributes[$name])){
			return $this->attributes[$name];				
		}
	}
	
}
