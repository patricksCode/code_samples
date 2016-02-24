<?php

namespace App\Http\Controllers;

use DB;
use \App\Models\Payment;
use \App\Models\UpdateLog;
use \App\Models\Variables;
use \Socrata;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Config\Repository;





class SearchController extends Controller
{
	

	
	protected $socrata;
	
	protected $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44.json";

	protected $columns = array( 
									"record_id"=>"record_id",
									"physician_profile_id"=>"physician_id",
									"teaching_hospital_name"=>"hospital name",
									"physician_first_name"=>"first name",
									"physician_middle_name"=>"middle name",
									"physician_last_name"=>"last name",
									"recipient_primary_business_street_address_line1"=>"address line1",
									"recipient_primary_business_street_address_line2"=>"address line2",
									"recipient_city"=>"city",
									"recipient_state"=>"state",
									"recipient_zip_code"=>"zip_code",
									"physician_primary_type"=>"type",
									"physician_specialty"=>"specialty",
									"applicable_manufacturer_or_applicable_gpo_making_payment_name"=>"company making payment",
									"applicable_manufacturer_or_applicable_gpo_making_payment_state"=>"company making payment state",
									"total_amount_of_payment_usdollars"=>"amount",
									"date_of_payment"=>"payment date",
									"form_of_payment_or_transfer_of_value"=>"form of payment",
									"nature_of_payment_or_transfer_of_value"=>"nature of payment",
									"contextual_information"=>"contextual information",
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
									"payment date"=>"date_of_payment",
	);
	
	public function __construct(){
			
		$appKey = config('OPEN_DATA_APP_KEY');
		$this->socrata = new \Socrata($this->endpoint, $appKey);
		
	}
	
	public function showIndex(Request $request)
	{
		 
		$limit=($request->has('limit') && $request->input('limit')>=10 && $request->input('limit')<=500)?$request->input('limit'):20;
		$offset=$request->has('offset')?$request->input('offset'):0;
	
		return view('index');
	}
	
	
	public function searchApi(Request $request)
	{


		if($request->has('type') && $request->input('type')=='ta'){
			
			$term = $request->input('term');
			$second = DB::table('payments')->select('physician_last_name as name')->where('physician_last_name', 'LIKE', '%' . $term . '%');
			$third = DB::table('payments')->select('applicable_manufacturer_or_applicable_gpo_making_payment_name as name' )->where('applicable_manufacturer_or_applicable_gpo_making_payment_name', 'LIKE', '%' . $term . '%');
			
			$respData = DB::table('payments')
			->select('teaching_hospital_name as name')
			->where('teaching_hospital_name', 'LIKE', '%' . $term . '%')
			->union($second)
			->union($third)
			->get();
			
		}else{
			
			if($request->has('limit')){
			
				
				if($request->input('limit')<=10){
					$limit=10;
					
				}
				elseif($request->input('limit')>=500){
					$limit=500;
	
				}else{
				
					$limit = $request->input('limit');
				}
			}
		
		
			$offset=$request->has('offset')?$request->input('offset'):0;
			
			$totalRecords =$this->getODTotalRecords();
			
			if($request->has('term')){
				$term = $request->input('term');
				
				$payments = DB::table('payments')
				->select($this->defaultColumns)
				->where('physician_last_name', 'LIKE', '%' . $term . '%')
				->orWhere('teaching_hospital_name', 'LIKE', '%' . $term . '%')
				->orWhere('applicable_manufacturer_or_applicable_gpo_making_payment_name', 'LIKE', '%' . $term . '%')
				->get();
				
			}else{

				$payments = DB::table('payments')->select($this->defaultColumns)->skip($offset)->take($limit)->get();

			}
			
			list($data, $colList) = $this->prepResp($payments);
			
			
			$respData=array($data, $colList, $offset, $totalRecords);
		
		}
		
		return response()->json($respData);
	}
	
	
	
	/*
	 * the Payments homepage
	 */
    public function showView(Request $request)
    {
    	
    	$limit=($request->has('limit') && $request->input('limit')>=10 && $request->input('limit')<=500)?$request->input('limit'):20;
    	$offset=$request->has('offset')?$request->input('offset'):0;

    	return view('search',  [		
    			'limit'=>$limit,
    			'offset'=>$offset,
    			"url"=>url()
    			]);

    }
    

	function generateXLS(Request $request){
		
		$term = $request->input('term');
		$limit = $request->input('limit');
		$offset = $request->input('offset');
		
		$excel ='';
		
		
		if($request->has('term')){
			$payments = DB::table('payments')
			->select($this->defaultColumns)
			->where('physician_last_name', 'LIKE', '%' . $term . '%')
			->orWhere('teaching_hospital_name', 'LIKE', '%' . $term . '%')
			->orWhere('applicable_manufacturer_or_applicable_gpo_making_payment_name', 'LIKE', '%' . $term . '%')
			->get();
		}elseif($request->has('offset') && $request->has('limit')){
			
			$payments = DB::table('payments')->select($this->defaultColumns)->skip($offset)->take($limit)->get();
		}else{
			echo "invalid";
			exit();
		}
		
		list($data, $colList) = $this->prepResp($payments);
		
		//print_r($colList); exit();
		
		foreach($colList as $col){
			$tempCol[]=$col;
		}

		$excel.=implode("\t", $tempCol) . "\n";
		
		foreach($data as $tempRow){
			$tempCol = array();

			
			foreach($tempRow as $key=>$col){
				$tempCol[]=$col;
			}
			

			$excel.=implode("\t", $tempCol). "\n";
			
		}

		
		return response($excel)
				->header('Content-Type', "application/vnd.ms-excel")
				->header('Content-disposition', 'attachment; filename=spreadsheet.xls');

		
	}
   
    
    
    
    /*
     * script to get data from OpenPaymentsData.CMS.gov
     */ 
    public function getData(){
    	
		$limit=500;
		
    	$totalRecords =$this->getODTotalRecords();
    	
    	$lastRecordUpdated = DB::table('upload_log')->max('last_record');
    	
    	if($lastRecordUpdated<$totalRecords){
    	
	    	$offset=$lastRecordUpdated?$lastRecordUpdated:0;
	    	
	    	
	    	$query=array('$select'=>array_keys($this->columns), '$order'=>"record_id");
	    	$params = $this->getParams($query, $limit, $offset);
	    	
	    	$response = $this->socrata->get($params);
	    	
	    	foreach($response as $key=>$row){
	    		
	    		$payment = \App\Models\Payment::create($row);
	
	    	}

	    	
	    	$logEntry = new \App\Models\UpdateLog;
	    	
	    	$logEntry->start_record = 0;
	    	
	    	$logEntry->last_record = $offset+$limit;
	    	
	    	echo $logEntry->last_record;
	    	
	    	$logEntry->save();

    	}

    }
    

    
    
    /*
     * method to get total records count from OpenPaymentsData.CMS.gov
     */
    private function getODTotalRecords(){
    	
    	$count = DB::table('variables')
    	->select('value')->where('name', '=', 'totalRecords')
    	->take(1)->get();

 
    	if(!count($count)){
	    	$query=array('$query'=>"select count(record_id) as total");
	    	$params = $this->getParams($query);
	    	 
	    	$response = $this->socrata->get($params);
	    	
	    	$variable = \App\Models\Variables::firstorcCreate(['name' => 'totalRecords', 'value'=>$response[0]['total']]);;
	    	
	    	$total = $variable->value;
    	}else{
    		$total= $count[0]->value;	
    	}

    	 
    	return $total;
    	
    }
    
    /*
     *  method to prepare data before it is sent to the view.
     */
    private function prepResp($data){
    	if(!is_array($data)){
    		return false;
    	}

    	$newParam=array();
    	$tempCols=array("");
    	$currCols=array();
    	

    	
    	foreach($data as $rKey=>$row){
    		foreach($row as $key=>$col){
    			if($key=="date_of_payment"){
    				$col=date_format(date_create($col),"m/d/Y");
    			}

    			$newParam[$rKey][$key]=$col;
    			
    			if(!array_search($key, $tempCols)){
    				$tempCols[]=$key ;
    			}	
    		}
    	}
    	// sort the columns in the right order
    	foreach($this->columns as $cKey=>$cVal){
    		if(array_search($cKey, $tempCols) && !array_search($cVal, $currCols )){
    			
    			$currCols[$cKey]=$cVal;
    		}
    	}

    	
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
    	
    	if(!isset($params['$query'])){
	    	if(!isset($params['$select'])){
	    		$params['$select'] = implode(", ",$this->defaultColumns);
	    	}
	    	
	    	//$params['$select'] = implode(", ",$this->defaultColumns);
	    	$params['$limit'] = $limit;
	    	$params['$offset'] =$offset;
    	}
    	
    	return $params;
    }
    
    
    
    
}