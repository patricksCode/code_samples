<!DOCTYPE html>
<html>
<head>
<title>Open Data Search</title>

	<link href="<?php echo URL::asset('css/search.css') ;?>" rel="stylesheet" type="text/css">

	<script  src="<?php echo URL::asset('js/angular.min.js');?>"></script>
	<script  src="<?php echo URL::asset('js/index.js');?>"></script>
	<script type="text/javascript">




		</script>
		<script  src="<?php echo URL::asset('js/search.js');?>"></script> 
		

    </head>
    

    <body >
        <div class="container" ng-app="index" ng-controller="indexController as search" ng-init="initPage()">
            <div  class="content">
                <div class="title">payments</div>   
                <p>initializing .....</p>            
            </div>
        </div>
    </body>
</html>
