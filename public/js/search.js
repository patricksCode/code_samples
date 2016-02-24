var searchAPI = angular.module('search', ['ui.bootstrap', 'angularSpinner']);

searchAPI.controller('searchController',['$scope', '$http','$interval', function($scope, $http, $interval) {

	$scope.apiUrl = apiUrl+"/ep/fe";
	
	var _selected;

	$scope.selected = undefined;
	
	$scope.limit = limit
	
	$scope.offset = 0;
	
	$scope.showTable = false;
	
	$scope.showPrev= true;
	$scope.showNext= true;
	$scope.showCount= true;
	
	var nextOffset;
	
	var prevOffset;
	
	$scope.term = "";

	var term = undefined;
	

	
  $scope.doLoad = function doLoad(fullUrl) {
			if(fullUrl!=""){
				$scope.showSpinner= true;
			    $http.get(fullUrl).then(function(response) {
			    	$scope.rows = response.data[0];
			    	$scope.columns = response.data[1];
			    	$scope.offset = parseInt(response.data[2]);
			    	
			    	if($scope.offset<0){
			    		$scope.offset = 0;
			    	}
			    	
			    	prevOffset = $scope.offset - $scope.rows.length;
			    	nextOffset = $scope.offset + $scope.rows.length;
			    	
			    	$scope.totalRecords = response.data[3];
			    	$scope.showTable = true;
			    	$scope.showSpinner= false;
		
			});
		}	    
	};
	
  $scope.initPage = function initPage() {
		
		doPaginate($scope.offset);
    
  };
	  
  $scope.doNext = function doNext() {

		doPaginate(nextOffset);
    
  };
  $scope.doPrev = function doPrev() {
		
		doPaginate(prevOffset);
    
  };
  
  $interval( function(){

	   if (navigator.onLine) {
			 $http.get('/gd');
		}
  }, 30000);
  

  
  /*
   * the following classes are for type ahead
   */
  $scope.getPayment = function(val) {
	    return $http.get($scope.apiUrl, {
	      params: {
	        term: val,
	        type: 'ta'
	      }
	    }).then(function(response){
	    	
	    		return response.data.splice(0, 20);
	    });
	  };

  $scope.ngModelOptionsSelected = function(value) {
    if (arguments.length) {
      _selected = value;
    } else {
      return _selected;
    }
  };

  $scope.modelOptions = {
    debounce: {
      default: 500,
      blur: 250
    },
    getterSetter: true
  };
  
  $scope.onSel = function ($item, $model, $label) {
	  $scope.showPrev= false;
	  $scope.showNext= false;
	  $scope.showCount= false;
	  $scope.term = $item.name;

	  
	  term = $scope.term;
	  doPaginate($scope.offset);


  };
  
  $scope.clearSearch = function () {
	  if(term!=undefined){
		  setSearchParamsTrue();
		  term = undefined;
	
		  
		  doPaginate($scope.offset);
	  }
  
  };
  
  $scope.reload = function(keyEvent) {

	  if (keyEvent.which === 13){
		  setSearchParamsTrue();
		  var params = "?offset="+$scope.offset+"&limit="+$scope.limit;
	      var fullUrl = $scope.apiUrl+params;
	      $scope.downloadUrl = "/xls"+params;
	  	  $scope.doLoad(fullUrl);
	  }
  };
  
  function setSearchParamsTrue(){
	  $scope.showPrev= true;
	  $scope.showNext= true;
	  $scope.showCount= true;
	  $scope.term="";
	  $scope.asyncSelected = "";
	  
	  
  }
  
  function doPaginate(offset){
	  
	  var params = "?offset=" + offset + "&limit="+$scope.limit;
	  
	  if(term!=undefined){
		 params+="&term="+$scope.term 
	  }
	  
	  var fullUrl = $scope.apiUrl+ params;
	  $scope.downloadUrl = "/xls"+params;
	  $scope.doLoad(fullUrl);
	  
  }
  

}]);

