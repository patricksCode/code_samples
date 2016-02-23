var searchAPI = angular.module('search', ['ui.bootstrap']);

searchAPI.controller('searchController',['$scope', '$http','$interval', function($scope, $http, $interval) {

	$scope.apiUrl = apiUrl+"/ep/fe";
	
	var _selected;

	$scope.selected = undefined;
	
	$scope.limit = limit
	
	$scope.offset = 0;
	
	$scope.showTable = false;
	
	  $scope.showPrev= true;
	  $scope.showNext= true;
	
	
	var nextOffset;
	
	var prevOffset;
	
	$scope.term = "";


	

	
  $scope.doLoad = function doLoad(fullUrl) {
			if(fullUrl!=""){

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
		
			});
		}	    
	};
	
  $scope.initPage = function initPage() {
		var fullUrl = $scope.apiUrl+"?offset="+$scope.offset+"&limit="+$scope.limit;
		$scope.doLoad(fullUrl);
    
  };
	  
  $scope.doNext = function doNext() {
		var fullUrl = $scope.apiUrl+"?offset=" + nextOffset + "&limit="+$scope.limit;
		$scope.doLoad(fullUrl);
    
  };
  $scope.doPrev = function doPrev() {

		var fullUrl = $scope.apiUrl+"?offset=" + prevOffset + "&limit="+$scope.limit;
		$scope.doLoad(fullUrl);
    
  };
  
  $scope.callAtInterval = function() {
      console.log("$scope.callAtInterval - Interval occurred");
  }

 /* $interval( function(){ 
	  $http.get('/gd')
  }, 30000);*/
  
  
  
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
	    		return response.data;
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
  
  $scope.onSelect = function ($item, $model, $label) {
	  $scope.showPrev= false;
	  $scope.showNext= false;
	  $scope.term = $item.name;
      var fullUrl = $scope.apiUrl+"?offset="+$scope.offset+"&limit="+$scope.limit+"&term="+$scope.term;
	  $scope.doLoad(fullUrl);


  };
  
  $scope.clearSearch = function () {
	  $scope.showPrev= true;
	  $scope.showNext= true;
	  $scope.term="";
	  $scope.asyncSelected = "";
      var fullUrl = $scope.apiUrl+"?offset="+$scope.offset+"&limit="+$scope.limit;
	  $scope.doLoad(fullUrl);

  };

  

}]);

