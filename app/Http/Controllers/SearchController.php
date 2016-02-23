<?php

namespace App\Http\Controllers;

use DB;
use \App\Models\Payment;
use \App\Models\UpdateLog;
use \App\Models\Variables;
use \Socrata;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;





class SearchController extends Controller
{
	
	protected $layout = 'layouts.master';
	
	protected $socrata;
	
	protected $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44.json";
	//protected  $endpoint = "https://openpaymentsdata.cms.gov/resource/mw4g-bs44";
	
	
	protected $appKey = "DDpGhebFsY3lFGL2r4mZe5Zwl";
	
	
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
									"entry_date"=>"payment_publication_date",
			
			
			
			
			
			
	);
	
	public function __construct(){
			
		$this->socrata = new \Socrata($this->endpoint, $this->appKey);
		
	}
	
	public function showIndex(Request $request)
	{
		 
		$limit=($request->has('limit') && $request->input('limit')>=10 && $request->input('limit')<=500)?$request->input('limit'):20;
		$offset=$request->has('offset')?$request->input('offset'):0;
	
		return view('index');
	}
	
	
	public function searchApi(Request $request)
	{


		if($request->input('type')=='ta'){
			
			$term = $request->input('term');
			//$respData="[{'name':'Alabama','flag':'5/5c/Flag_of_Alabama.svg/45px-Flag_of_Alabama.svg.png'},{'name':'Alaska','flag':'e/e6/Flag_of_Alaska.svg/43px-Flag_of_Alaska.svg.png'},{'name':'Arizona','flag':'9/9d/Flag_of_Arizona.svg/45px-Flag_of_Arizona.svg.png'},{'name':'Arkansas','flag':'9/9d/Flag_of_Arkansas.svg/45px-Flag_of_Arkansas.svg.png'},{'name':'California','flag':'0/01/Flag_of_California.svg/45px-Flag_of_California.svg.png'},{'name':'Colorado','flag':'4/46/Flag_of_Colorado.svg/45px-Flag_of_Colorado.svg.png'},{'name':'Connecticut','flag':'9/96/Flag_of_Connecticut.svg/39px-Flag_of_Connecticut.svg.png'},{'name':'Delaware','flag':'c/c6/Flag_of_Delaware.svg/45px-Flag_of_Delaware.svg.png'},{'name':'Florida','flag':'f/f7/Flag_of_Florida.svg/45px-Flag_of_Florida.svg.png'},{'name':'Georgia','flag':'5/54/Flag_of_Georgia_%28U.S._state%29.svg/46px-Flag_of_Georgia_%28U.S._state%29.svg.png'},{'name':'Hawaii','flag':'e/ef/Flag_of_Hawaii.svg/46px-Flag_of_Hawaii.svg.png'},{'name':'Idaho','flag':'a/a4/Flag_of_Idaho.svg/38px-Flag_of_Idaho.svg.png'},{'name':'Illinois','flag':'0/01/Flag_of_Illinois.svg/46px-Flag_of_Illinois.svg.png'},{'name':'Indiana','flag':'a/ac/Flag_of_Indiana.svg/45px-Flag_of_Indiana.svg.png'},{'name':'Iowa','flag':'a/aa/Flag_of_Iowa.svg/44px-Flag_of_Iowa.svg.png'},{'name':'Kansas','flag':'d/da/Flag_of_Kansas.svg/46px-Flag_of_Kansas.svg.png'},{'name':'Kentucky','flag':'8/8d/Flag_of_Kentucky.svg/46px-Flag_of_Kentucky.svg.png'},{'name':'Louisiana','flag':'e/e0/Flag_of_Louisiana.svg/46px-Flag_of_Louisiana.svg.png'},{'name':'Maine','flag':'3/35/Flag_of_Maine.svg/45px-Flag_of_Maine.svg.png'},{'name':'Maryland','flag':'a/a0/Flag_of_Maryland.svg/45px-Flag_of_Maryland.svg.png'},{'name':'Massachusetts','flag':'f/f2/Flag_of_Massachusetts.svg/46px-Flag_of_Massachusetts.svg.png'},{'name':'Michigan','flag':'b/b5/Flag_of_Michigan.svg/45px-Flag_of_Michigan.svg.png'},{'name':'Minnesota','flag':'b/b9/Flag_of_Minnesota.svg/46px-Flag_of_Minnesota.svg.png'},{'name':'Mississippi','flag':'4/42/Flag_of_Mississippi.svg/45px-Flag_of_Mississippi.svg.png'},{'name':'Missouri','flag':'5/5a/Flag_of_Missouri.svg/46px-Flag_of_Missouri.svg.png'},{'name':'Montana','flag':'c/cb/Flag_of_Montana.svg/45px-Flag_of_Montana.svg.png'},{'name':'Nebraska','flag':'4/4d/Flag_of_Nebraska.svg/46px-Flag_of_Nebraska.svg.png'},{'name':'Nevada','flag':'f/f1/Flag_of_Nevada.svg/45px-Flag_of_Nevada.svg.png'},{'name':'New Hampshire','flag':'2/28/Flag_of_New_Hampshire.svg/45px-Flag_of_New_Hampshire.svg.png'},{'name':'New Jersey','flag':'9/92/Flag_of_New_Jersey.svg/45px-Flag_of_New_Jersey.svg.png'},{'name':'New Mexico','flag':'c/c3/Flag_of_New_Mexico.svg/45px-Flag_of_New_Mexico.svg.png'},{'name':'New York','flag':'1/1a/Flag_of_New_York.svg/46px-Flag_of_New_York.svg.png'},{'name':'North Carolina','flag':'b/bb/Flag_of_North_Carolina.svg/45px-Flag_of_North_Carolina.svg.png'},{'name':'North Dakota','flag':'e/ee/Flag_of_North_Dakota.svg/38px-Flag_of_North_Dakota.svg.png'},{'name':'Ohio','flag':'4/4c/Flag_of_Ohio.svg/46px-Flag_of_Ohio.svg.png'},{'name':'Oklahoma','flag':'6/6e/Flag_of_Oklahoma.svg/45px-Flag_of_Oklahoma.svg.png'},{'name':'Oregon','flag':'b/b9/Flag_of_Oregon.svg/46px-Flag_of_Oregon.svg.png'},{'name':'Pennsylvania','flag':'f/f7/Flag_of_Pennsylvania.svg/45px-Flag_of_Pennsylvania.svg.png'},{'name':'Rhode Island','flag':'f/f3/Flag_of_Rhode_Island.svg/32px-Flag_of_Rhode_Island.svg.png'},{'name':'South Carolina','flag':'6/69/Flag_of_South_Carolina.svg/45px-Flag_of_South_Carolina.svg.png'},{'name':'South Dakota','flag':'1/1a/Flag_of_South_Dakota.svg/46px-Flag_of_South_Dakota.svg.png'},{'name':'Tennessee','flag':'9/9e/Flag_of_Tennessee.svg/46px-Flag_of_Tennessee.svg.png'},{'name':'Texas','flag':'f/f7/Flag_of_Texas.svg/45px-Flag_of_Texas.svg.png'},{'name':'Utah','flag':'f/f6/Flag_of_Utah.svg/45px-Flag_of_Utah.svg.png'},{'name':'Vermont','flag':'4/49/Flag_of_Vermont.svg/46px-Flag_of_Vermont.svg.png'},{'name':'Virginia','flag':'4/47/Flag_of_Virginia.svg/44px-Flag_of_Virginia.svg.png'},{'name':'Washington','flag':'5/54/Flag_of_Washington.svg/46px-Flag_of_Washington.svg.png'},{'name':'West Virginia','flag':'2/22/Flag_of_West_Virginia.svg/46px-Flag_of_West_Virginia.svg.png'},{'name':'Wisconsin','flag':'2/22/Flag_of_Wisconsin.svg/45px-Flag_of_Wisconsin.svg.png'},{'name':'Wyoming','flag':'b/bc/Flag_of_Wyoming.svg/43px-Flag_of_Wyoming.svg.png'}]";
			//$first = DB::table('payments')->select('teaching_hospital_name as name')->where('name', 'LIKE', '%' . $term . '%');
			$second = DB::table('payments')->select('physician_last_name as name')->where('physician_last_name', 'LIKE', '%' . $term . '%');
			$third = DB::table('payments')->select('applicable_manufacturer_or_applicable_gpo_making_payment_name as name')->where('applicable_manufacturer_or_applicable_gpo_making_payment_name', 'LIKE', '%' . $term . '%');
			
			$respData = DB::table('payments')
			->select('teaching_hospital_name as name')
			->where('teaching_hospital_name', 'LIKE', '%' . $term . '%')
			->union($second)
			->union($third)
			->get();
			
			/*$respData = DB::table('payments')
				->distinct($this->defaultColumns)
				->where('teaching_hospital_name', 'LIKE', '%' . $term . '%')
				->orWhere('physician_last_name', 'LIKE', '%' . $term . '%')
				->orWhere('physician_primary_type', 'LIKE', '%' . $term . '%')
				->orWhere('physician_specialty', 'LIKE', '%' . $term . '%')
				->orWhere('applicable_manufacturer_or_applicable_gpo_making_payment_name', 'LIKE', '%' . $term . '%')
				->get();*/
			
			
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
			
			
			$payments = DB::table('payments')->select($this->defaultColumns)->skip($offset)->take($limit)->get();
			
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
    
    public function json(){
    	
    	$respData=json_decode('[
			    {
			        "registration": "C-FNND",
			        "operator": "Air Canada",
			        "manufacturer": "Boeing",
			        "type": "777-200"
			    },
			    {
			        "registration": "PH-BFW",
			        "operator": "KLM Royal Dutch Airlines",
			        "manufacturer": "Boeing",
			        "type": "747-400"
			    },
			    {
			        "registration": "N124US",
			        "operator": "US Airways",
			        "manufacturer": "Airbus",
			        "type": "A320-200"
			    },
			    {
			        "registration": "A6-EEU",
			        "operator": "Emirates",
			        "manufacturer": "Airbus",
			        "type": "A380-800"
			    },
			    {
			        "registration": "VH-LQL",
			        "operator": "Qantas",
			        "manufacturer": "Bombardier",
			        "type": "DHC-8-400"
			    }]');
    	
    	return response()->json($respData);
    	
    	
    }
    
    public function test(){
    	
    	return view('test',  ["url"=>url()]);
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
    	$query=array('$query'=>"select count(record_id) as total");
    	$params = $this->getParams($query);
    	 
    	$response = $this->socrata->get($params);
    	
    	$variable = \App\Models\Variables::create(['name' => 'totalRecords', 'value'=>$response[0]['total']]);;
    	

    	 
    	return $variable->value;
    	
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
    		
    		//$newParam[$rKey]['name']=array();
    		//$newParam[$rKey]['drugs']=array();
    		//$newParam[$rKey]['devices']=array();
    		
    		foreach($row as $key=>$col){

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