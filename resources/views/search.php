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
            
            table.thRow th{ padding: 10px; border: 1px solid #cccccc;
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">search</div>
                <table>
                	
	                <tr class="thRow">
		                <?php 
		                foreach($columns as $th){?>
	                		<th><?php echo $th; ?></th>
	                    <?php }?>
	                
	                </tr>
	                
	                
               		<?php 
               		foreach($rows as $data){
               			echo "<tr>";
	                	foreach($columns as $rkey=>$rVal){
	                		
	                		echo "<td>".(isset($data[$rkey])?$data[$rkey]:"")."</td>";
	                		
	                	}
	                	echo "</tr>";
               		}?>
	                
	                
                
                
                
                
                </table>
                
                
                
            </div>
        </div>
    </body>
</html>
