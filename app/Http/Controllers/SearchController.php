<?php

namespace App\Http\Controllers;


use App\Http\Controllers\SearchController;
use \Socrata;


class SearchController extends Controller
{
	
	
	protected $socrata;
	
	protected $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44.json";
	//protected  $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44";
	
	
	protected $appKey = "DDpGhebFsY3lFGL2r4mZe5Zwl";
	
	/*protected $columns = array( "physician_id"=>"physician_profile_id",
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
								"payment_date"=>"date_of_payment",
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
								"entry_date"=>"payment_publication_date",

			
	);*/
	
	protected $columns = array( "physician_profile_id"=>"physician_id",
			"teaching_hospital_name"=>"hospital_name",
			"physician_first_name"=>"first_name",
			"physician_middle_name"=>"middle_name",
			"physician_last_name"=>"last_name",
			"recipient_primary_business_street_address_line1"=>"address_line1",
			"recipient_primary_business_street_address_line2"=>"address_line2",
			"recipient_city"=>"city",
			"recipient_state"=>"state",
			"recipient_zip_code"=>"zip_code",
			"physician_primary_type"=>"type",
			"physician_specialty"=>"specialty",
			"applicable_manufacturer_or_applicable_gpo_making_payment_name"=>"company_making_payment",
			"applicable_manufacturer_or_applicable_gpo_making_payment_state"=>"company_making_payment_state",
			"total_amount_of_payment_usdollars"=>"amount",
			"date_of_payment"=>"payment_date",
			"form_of_payment_or_transfer_of_value"=>"form_of_payment",
			"nature_of_payment_or_transfer_of_value"=>"nature_of_payment",
			"name_of_associated_covered_drug_or_biological1"=>"drug1",
			"name_of_associated_covered_drug_or_biological2"=>"drug2",
			"name_of_associated_covered_drug_or_biological3"=>"drug3",
			"name_of_associated_covered_drug_or_biological4"=>"drug4",
			"name_of_associated_covered_drug_or_biological5"=>"drug5",
			"name_of_associated_covered_device_or_medical_supply1"=>"device1",
			"name_of_associated_covered_device_or_medical_supply2"=>"device2",
			"name_of_associated_covered_device_or_medical_supply3"=>"device3",
			"name_of_associated_covered_device_or_medical_supply4"=>"device4",
			"name_of_associated_covered_device_or_medical_supply5"=>"device5",
			"payment_publication_date"=>"entry_date",
	
				
	);
	
	protected $defaultColumns = array( 
									"hospital_name"=>"teaching_hospital_name",
									"first_name"=>"physician_first_name",
									"middle_name"=>"physician_middle_name",
									"last_name"=>"physician_last_name",
									"type"=>"physician_primary_type",
									"specialty"=>"physician_specialty",
									"company_making_payment"=>"applicable_manufacturer_or_applicable_gpo_making_payment_name",
									"amount"=>"total_amount_of_payment_usdollars",
									"entry_date"=>"payment_publication_date",
			
			
			
			
			
			
	);
	
	public function __construct(){
			
		$this->socrata = new \Socrata($this->endpoint, $this->appKey);
		
	}

    public function showView()
    {
    	
    	

    	
    	//print_r($params);
    	
    	$params = $this->getParams();
    	
    	$response = $this->socrata->get($params);
    	//print_r(json_encode($response));
    	
    	list($data, $colList) = $this->prepResp($this->socrata->get($params));
    	
    	
    	//print_r($data);
    	//print_r($colList);
    	
    	

        return view('search',  ['rows' => $data, 'columns'=>$colList]);
    }
    
    public function searchApi()
    {

    	return view('search',  ['name' => 'James']);
    }
    
    private function prepResp($data){
    	if(!is_array($data)){
    		return false;
    	}
    	//print_r($data);
    	$newParam=array();
    	$tempCols=array("");
    	$currCols=array();
    	
    	//$name = array("","physician_first_name","physician_middle_name","physician_last_name");
    	$drugs = array("","name_of_associated_covered_drug_or_biological1",
						"name_of_associated_covered_drug_or_biological2",
						"name_of_associated_covered_drug_or_biological3",
						"name_of_associated_covered_drug_or_biological4",
						"name_of_associated_covered_drug_or_biological5",);
   		$devices = array("name_of_associated_covered_device_or_medical_supply1",
							"name_of_associated_covered_device_or_medical_supply2",
							"name_of_associated_covered_device_or_medical_supply3",
							"name_of_associated_covered_device_or_medical_supply4",
							"name_of_associated_covered_device_or_medical_supply5"
   				);
    	
    	foreach($data as $rKey=>$row){
    		$newParam[$rKey]['name']=array();
    		$newParam[$rKey]['drugs']=array();
    		$newParam[$rKey]['devices']=array();
    		foreach($row as $key=>$col){
    			//echo $key;
    			//print_r($newParam);
    			/*if(array_search($key,$name)){
    				$newParam[$rKey]['name'][$key]=$col;
    			}*/
    			if(array_search($key,$drugs)){
    				$newParam[$rKey]['drugs'][]=$col;
    				
    			}
    			elseif(array_search($key,$drugs)){
    				$newParam[$rKey]['devices'][]=$col;
    			
    			}
    			else{
    				$newParam[$rKey][$key]=$col;
    			}
    			if(!array_search($key, $tempCols)){
    				$tempCols[]=$key ;
    			}	
    			
    			
    		}


    		if(isset($newParam[$rKey]['name'])){
    			$newParam[$rKey]['name'] = implode(", ",$newParam[$rKey]['name']);
    			
    		}
    		if(isset($newParam[$rKey]['drugs'])){
    			$newParam[$rKey]['drugs'] = implode(", ",$newParam[$rKey]['drugs']);
    			 
    		}
    		if(isset($newParam[$rKey]['devices'])){
    			$newParam[$rKey]['devices'] = implode(", ",$newParam[$rKey]['devices']);
    		
    		}
    		
    	}
    	// sort the columns in the right order
    	foreach($this->columns as $cKey=>$cVal){
    		if(array_search($cKey, $tempCols) && !array_search($cVal, $currCols )){
    			$currCols[$cKey]=$cVal;
    		}
    	}
    	
    	//print_r($currCols);
    	
    	
    	return array($newParam, $currCols);
    	
    }
    
    
    
    private function getParams($query=array(), $limit=20, $offset=0){
    	
    	foreach( $query as $key=>$val){
    		if(is_array($val)){
    			$params[$key]=implode(", ",$val);
    		}else{
    			$params[$key]= $val;
    		}
    	}
    	
    	if(!isset($params['$select'])){
    		$params['$select'] = implode(", ",$this->defaultColumns);
    	}
    	
    	//$params['$select'] = implode(", ",$this->defaultColumns);
    	$params['$limit'] = $limit;
    	$params['$offset'] =$offset;
    	
    	return $params;
    }
    
    
    
    
}