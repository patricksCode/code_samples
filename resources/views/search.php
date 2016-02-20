<!DOCTYPE html>
<html>
    <head>
        <title>Open Data Search</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

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
            
            
            table{ width: 75%; margin: 0 auto; float: left;}

            
            .thRow th, .dRow td{ padding: 10px; border: 1px solid #cccccc; margin 0px; }
            
            .navRow{ width: 100%; margin: 0 auto; float: left;}
            
            .prev, .next{width: 10%}
            
            .search{width: 80%}
            
            .innerBody{ width: 75%; margin: 0 auto;}


            
            .prev {float: left;}
            .next{float: right;}
        </style>
    </head>
    

    <body>
        <div class="container">
            <div class="content">
                <div class="title">search</div>
                <div class="innerBody">
                	<div class="navRow">
	                	<div class="prev"><a href="">PREV</a></div>
	                	<div class="next"><a href="">NEXT</a></div>
                	</div>
	                <table>
	                	<tbody>
		                <tr class="thRow">
			                <?php 
			                foreach($columns as $th){?>
		                		<th><?php echo $th; ?></th>
		                    <?php }?>
		                
		                </tr>
		                
		                
	               		<?php 
	               		foreach($rows as $data){
	               			echo "<tr class='dRow'>";
		                	foreach($columns as $rkey=>$rVal){
		                		
		                		echo "<td>".(isset($data[$rkey])?$data[$rkey]:"")."</td>";
		                		
		                	}
		                	echo "</tr>";
	               		}?>
		                </tbody>
		                
	                
	                
	                
	                
	                </table>
                </div>
                
                
            </div>
        </div>
    </body>
</html>
