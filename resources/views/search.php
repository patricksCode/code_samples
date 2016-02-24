<!DOCTYPE html>
<html>
    <head>
        <title>Open Data Search</title>

        <!--  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->
        
         <link href="<?php echo URL::asset('css/bootstrap.css') ;?>" rel="stylesheet" type="text/css">
		<link href="<?php echo URL::asset('css/search.css') ;?>" rel="stylesheet" type="text/css">

		<script  src="<?php echo URL::asset('js/angular.min.js');?>"></script> 
		<script  src="<?php echo URL::asset('js/ui-bootstrap-tpls-1.1.2.min.js') ;?>"></script> 
		<script  src="<?php echo URL::asset('js/spin.js');?>"></script> 
		<script  src="<?php echo URL::asset('js/angular-spinner.js');?>"></script> 
		<script type="text/javascript">

			var limit =<?php echo $limit?>;

			var offset = <?php echo $offset; ?>;

			var apiUrl = "<?php echo $url->to('/'); ?>";


		</script>
		<script  src="<?php echo URL::asset('js/search.js');?>"></script> 
		


    <body >
        <div class="container" ng-app="search" ng-controller="searchController as search" ng-init="initPage()" >
            <div  class="content">
            <span us-spinner spinner-on="showSpinner"></span>
                <div class="title">payments</div>
                <p ng-hide="showTable">starting .....</p> 
                <div class="innerBody" ng-show="showTable">
                	<div class="navigation">

						<!--<div>
							<input type="text"  ng-model="searchText" placeholder="Search"><a ng-click="doNext()" >Search >></a>
						</div>-->
						
						<!-- <pre>Model: {{asyncSelected | json}}</pre>-->
						<div style="width: 200px; margin: 0px auto;">
					    	<input type="text" ng-model="asyncSelected"   placeholder="Search" uib-typeahead="term.name for term in getPayment($viewValue)" typeahead-on-select='onSel($item, $model, $label)' typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control">
					   		<a ng-click="clearSearch()" >Clear Search</a>
					    </div>

	
					
					</div>
					<div class="navigation">
						<div class="prev">


                				<a ng-show="offset && showPrev" ng-click="doPrev()"  >PREV</a>&nbsp;

                		</div>
                		<div class="countDiv" >
                				<label>Number of Rows:</label> <input type="number" min="0" max="500" maxlength="3" size="3" ng-keypress="reload($event)" ng-model="limit">
                				
                		</div>
                		<div class="next">

                				<a ng-show="showNext" ng-click="doNext()" >NEXT</a>
                		</div>

					
					</div>
					<div class="navigation">

						<div style="width: 50%; display: inline; float: left; text-align: left;" ng-Show="showCount">
							Row <span class="boldText">{{ offset }}</span> to <span class="boldText">{{ offset + rows.length }}</span> of <span class="boldText">{{ totalRecords }}</span> Records
						</div>
						<div style="width: 50%; display: inline; float: right; text-align: right;"><a href="{{ downloadUrl }}">Download</a></div>

					
					</div>
	                 <table>
	                	<tbody>

		                 <tr class="thRow">

		                		<th ng-repeat='ch in columns'>{{ ch }}</th>

		                
		                </tr>
		                <tr class='dRow' ng-repeat='row in rows'>
		                
		                	<td ng-repeat='col in row'>{{ col }}</td>
		                </tr>
		                

		                </tbody>
	                </table>
	                
	                
	                
                </div>

            </div>
        </div>
    </body>
</html>
