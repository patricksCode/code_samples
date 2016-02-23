<!DOCTYPE html>
<html>
<head>
<title>Open Data Search</title>

<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


	<!-- <script  src="<?php echo URL::asset('js/jquery.js');?>"></script>-->
	<script  src="<?php echo URL::asset('js/angular.min.js');?>"></script>
	<script  src="<?php echo URL::asset('js/index.js');?>"></script>
	<script type="text/javascript">




		</script>
		<script  src="<?php echo URL::asset('js/search.js');?>"></script> 
		
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            
            .innerBody{ 
            	width: 70%; 
            	margin: 0 auto;
            	/*border: 1px solid black;*/
				display: inline-block;
            	}

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            
            

        </style>
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
