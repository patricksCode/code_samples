angular.module('search', [])
.controller('searchController', function($scope, $http) {

	this.apiUrl = apiUrl+"/ep/fe";
	
	$scope.limit = limit
	
	this.offset = offset;
	
	var nextOffset = offset+limit;
	
	var prevOffset = offset-limit;


	
	this.doPrev = function doPrev() {
	    window.alert(this.apiUrl);
	    
	  };
	  
	this.doNext = function doNext() {
		var fullUrl = this.apiUrl+"?offset=" + nextOffset + "&limit="+$scope.limit;
	    $http.get(fullUrl).then(function(response) {
	    	$scope.rows = response.data[0];
	    	$scope.columns = response.data[1];

	    	nextOffset = parseInt(response.data[2]) + $scope.rows.length;


	    });
	    
	  };
	  
		this.doPrev = function doPrev() {
			var fullUrl = this.apiUrl+"?offset=" + prevOffset + "&limit="+$scope.limit;
		    $http.get(fullUrl).then(function(response) {
		    	$scope.rows = response.data[0];
		    	$scope.columns = response.data[1];

		    	prevOffset = parseInt(response.data[2]) - $scope.rows.length;


		    });
		    
		  };
});