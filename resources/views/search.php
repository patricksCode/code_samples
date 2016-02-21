<!DOCTYPE html>
<html>
    <head>
        <title>Open Data Search</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        

		<script  src="<?php echo URL::asset('js/jquery.js');?>"></script> 
		<script  src="<?php echo URL::asset('js/angular.min.js');?>"></script> 
		<script type="text/javascript">

			var limit =<?php echo $limit?>;

			var offset = <?php echo $offset; ?>;


			var apiUrl = "<?php echo $url->to('/'); ?>";


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
            
            
            table{
            	margin: 0 auto; border-spacing: 0px; border: 1px solid #cccccc;
            }

            
            .thRow th, .dRow td{
            	padding: 10px; border-bottom: 1px solid #cccccc; margin 0px; 
            }
            
            .navRow{
            	width: 100%; margin: 0 auto; float: left;
            }
            
            .prev, .next{
            	width: 10%
            }
            
            .search{
            	width: 80%
            }
            
            .navigation{
            	width: 100%;  float: left;
            }



            
            .prev {
            	float: left;
            }
            .next{
            	float: right;
            }
            .searchDiv{

            	display: inline;
            }
        </style>
    </head>
    

    <body >
        <div class="container">
            <div  class="content">
                <div class="title">search</div>
                <div class="innerBody" ng-app="search" ng-controller="searchController as search">
					<div class="navigation">
						<div class="prev">
							<?php //if(($prevOffset-$limit)>=-1){?>

                				<a ng-click="search.doPrev()" >PREV</a>
							<?php //} ?>
                		</div>
                		<div class="searchDiv">
                				<label>Number of Rows:</label> <input type="number" min="0" max="1000" maxlength="3" size="4" ng-model="search.limit">
                				
                		</div>
                		<div class="next">

                				<a ng-click="search.doNext()" >NEXT</a>
                		</div>
					
					
					</div>
	                 <table>
	                	<tbody>

		               <!-- <tr class="thRow">
			                <?php 
			                foreach($columns as $th){?>
		                		<th><?php echo $th; ?></th>
		                    <?php }?>
		                
		                </tr>-->
		                 <tr class="thRow">

		                		<th ng-repeat='ch in columns'>{{ ch }}</th>

		                
		                </tr>
		                <tr class='dRow' ng-repeat='row in rows'>
		                
		                	<td ng-repeat='col in row'>{{ col }}</td>
		                </tr>
		                
		                
	               		<?php 
	               		/*foreach($rows as $data){
	               			echo "<tr class='dRow' ng-repeat='row in rows'>";
		                	foreach($columns as $rkey=>$rVal){
		                		echo "{{ row }}";
		                		//echo "<td ng-repeat='col in row'>".(isset($data[$rkey])?$data[$rkey]:"")."{{ col }}</td>";
		                		
		                		//echo "<td ng-repeat='col in row'>{{ col }}</td>";
		                		
		                	}
		                	echo "</tr>";
	               		} */?>
		                </tbody>
	                </table>
	                
	                
	                
                </div>
                
                
            </div>
        </div>
    </body>
</html>
