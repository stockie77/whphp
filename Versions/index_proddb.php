<?php

	$database="proddbe";
    $user = "";
    $password = "";   

    $conn = db2_connect($database, $user, $password);    



	if( $conn )
	{
		echo "Connection succeeded.";
		$sql = 'SELECT IEEUSER.USER_ID from TESTER.IEEUSER as IEEUSER'; 
		  
		$stmt = db2_prepare($conn, $sql);
		$result=db2_execute($stmt);
		if ($result)
		{
				while ($user = db2_fetch_object($stmt)) 
						{

							echo $user->USER_ID;
						}       


			# Disconnect
			#
			
				db2_close($conn);	
		}
		else
		{
			print db2_stmt_errormsg ();
		}		

	}
	else
	{
		print db2_conn_errormsg();	
		echo "Connection failed.";
	}
?>
