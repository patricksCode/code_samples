angular.module('search', [])
.controller('searchController',['$scope', '$http', function($scope, $http) {

	$scope.apiUrl = apiUrl+"/ep/fe";
	
	$scope.limit = limit
	
	$scope.offset = 0;
	
	
	var nextOffset;
	
	var prevOffset;


	

	
  $scope.doLoad = function doLoad(fullUrl) {
			if(fullUrl!=""){
			    $http.get(fullUrl).then(function(response) {
			    	$scope.rows = response.data[0];
			    	$scope.columns = response.data[1];
			    	$scope.offset = parseInt(response.data[2]);
			    	
			    	prevOffset = $scope.offset - $scope.rows.length;
			    	nextOffset = $scope.offset + $scope.rows.length;
			    	
			    	$scope.totalRecords = response.data[3];
	
		
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

  

}]);