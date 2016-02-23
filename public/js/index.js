var ctrl = angular.module('index', []);



ctrl.controller('indexController',['$scope', '$http','$timeout', '$window', function($scope, $http, $timeout, $window) {


	
	  $scope.initPage = function initPage() {
		  
		  $http.get('/gd');
		  $timeout($scope.doInit, 5000);
	    
	  };
	  
	  $scope.doInit = function doInit(){

		  $window.location.href = '/search';
	  };


  
  //$location.path("route")
}]);