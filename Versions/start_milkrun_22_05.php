

<html>
    <head>
        <link rel="stylesheet" href="/public/css/pda.css" type="text/css">
        <script type="text/javascript" charset="utf-8" src="/public/javascripts/ebapi-modules.js"></script>
        <script type="text/javascript" charset="utf-8" src="/public/javascripts/pda.js"></script>

        <script type="text/javascript">

            window.addEventListener('DOMContentLoaded', loadEvent);
            window.addEventListener('unload',unloadEvent);
        </script>     
    </head>
	

	<body>
		<?php echo $_GET["name"]; ?><br>

        <?php
        $database = "DB2_DATA";
        $user = "";
        $password = "";       
		
        //include('datainterface.php');
		echo "datainterface";
		//$data=new databases($database, $user, $password);
		//echo  $data->getConst();
		
       // $sql = 'SELECT * from WAREHOUSE.USERS WHERE USER_ID = 963';
		//$datacontainer=$data->get_RS($sql,7);
        echo "  init datacontainer";
        /*
        foreach ($datacontainer as $erg) 
        {
            echo "Ausgabe \n";
            //print $erg[0];
            echo $user['USER_ID'];
        }
        
		 */
	
        $conn = db2_connect($database, $user, $password);
	
        if ($conn) {
            
			
			echo "Connection succeeded.";

       	    $sql = 'SELECT * from WAREHOUSE.USERS where USER_ID = 963';
            $stmt = db2_prepare($conn, $sql);
            $result=db2_execute($stmt, array(0));

            while ($user = db2_fetch_object($stmt)) 
                {

                    echo $user->USER_ID;
                }       

				
            db2_close($conn);
			
        }
        else {
			 echo "Connection failed.";
			 print db2_conn_errormsg();
       
        }
      
        ?>
	</body>


</html>