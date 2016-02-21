angular.module('search', [])
.controller('searchController', function($scope, $http) {

	this.apiUrl = apiUrl+"/ep/fe";
	
	this.limit = limit
	
	this.offset = offset;
	
	this.nextOffset = offset+limit;
	
	this.prevOffset = offset-limit;


	
	this.doPrev = function doPrev() {
	    window.alert(this.apiUrl);
	    
	  };
	  
	this.doNext = function doNext() {
		var fullUrl = this.apiUrl+"?offset="+this.nextOffset+"&limit="+this.limit;
	    $http.get(fullUrl).then(function(response) {
	    	$scope.rows = response.data[0];
	    	$scope.columns = response.data[1];

	    });
	    
	  };
});