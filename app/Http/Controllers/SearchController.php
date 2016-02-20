<?php

namespace App\Http\Controllers;


use App\Http\Controllers\SearchController;
use \Socrata;


class SearchController extends Controller
{
	
	
	protected $socrata;
	
	protected $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44.json";
	
	protected $appKey = "DDpGhebFsY3lFGL2r4mZe5Zwl";
	
	protected $columns = array( "physician_id"=>"physician_profile_id",
								"hospital_name"=>"teaching_hospital_name",
								"first_name"=>"physician_first_name",
								"middle_name"=>"physician_middle_name",
								"last_name"=>"physician_last_name",
								"address_line1"=>"recipient_primary_business_street_address_line1",
								"address_line2"=>"recipient_primary_business_street_address_line2",
								"city"=>"recipient_city",
								"state"=>"recipient_state",
								"zip_code"=>"recipient_zip_code",
								"type"=>"physician_primary_type",
								"specialty"=>"physician_specialty",
								"company_making_payment"=>"applicable_manufacturer_or_applicable_gpo_making_payment_name",
								"company_making_payment_state"=>"applicable_manufacturer_or_applicable_gpo_making_payment_state",
								"amount"=>"total_amount_of_payment_usdollars",
								"paymenet_date"=>"date_of_payment",
								"form_of_payment"=>"form_of_payment_or_transfer_of_value",
								"nature_of_payment"=>"nature_of_payment_or_transfer_of_value",
								"drug1"=>"name_of_associated_covered_drug_or_biological1",
								"drug2"=>"name_of_associated_covered_drug_or_biological2",
								"drug3"=>"name_of_associated_covered_drug_or_biological3",
								"drug4"=>"name_of_associated_covered_drug_or_biological4",
								"drug5"=>"name_of_associated_covered_drug_or_biological5",
								"device1"=>"name_of_associated_covered_device_or_medical_supply1",
								"device2"=>"name_of_associated_covered_device_or_medical_supply2",
								"device3"=>"name_of_associated_covered_device_or_medical_supply3",
								"device4"=>"name_of_associated_covered_device_or_medical_supply4",
								"device5"=>"name_of_associated_covered_device_or_medical_supply5",
								"payment_publication_date"=>"payment_publication_date",

			
	);
	
	public function __construct(){
			
		$this->socrata = new \Socrata($this->endpoint);
		
	}

    public function showView()
    {
    	
    	$response = $this->socrata->get("");
    	 
    	print_r($response);

        return view('search',  ['name' => 'James']);
    }
    
    public function searchApi()
    {

    	return view('search',  ['name' => 'James']);
    }
    
    
}