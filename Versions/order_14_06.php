<?php
session_start();
extract($_REQUEST, EXTR_SKIP);
?>
<html>
    <?php include_once "templates/header.phtml" ?>
        <center>
            <h1>Order</h1>
 
<head>
  

</head>    
<?php if ($_SESSION["user_surename"]) { ?>
    <p class="text">CURRENT USER: <?=$_SESSION["user_surename"]?> </p>
    <p class="text">MODE: <?=$_SESSION["mode"]?> </p>
    

<?php } else 
    {
        header("Location:pda_index.php");
    } 
  ?>

<?php
     include('datainterface.php');
     $data_prod=new databases($_SESSION["database_wh"],"","");  

     $sql="SELECT min(cycle) as cycle FROM WAREHOUSE.history history  WHERE history.created_at > ? 
     AND history.created_at < ?";
     $cycle_fields1 ="'2019-06-11 00:00:00'";
     $cycle_fields2="'2019-06-11 23:00:00'";
     $datacontainer=$data_prod->get_RS($sql,$cycle_fields1,$cycle_fields1);
     echo $datacontainer[0][1];
     foreach ($datacontainer as $erg) 
                {
                    echo "Ausgabe Tester \n";
                  //  foreach ($erg as $key ) {
                   //      echo $key;
                   //  }
                   echo $erg; 
                   
                }
?>
 

</center>

<?php include_once "templates/page_end.phtml" ?>
</html>