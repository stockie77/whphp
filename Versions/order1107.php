<?php
session_start();
extract($_REQUEST, EXTR_SKIP);
?>
<html>
    <?php include_once "templates/header.phtml" ?>
        <center>
            <h1>Order</h1>
 
<head>
  <title>PDAORDER</title>

</head> 


<body onload="loadEvent()" onunload="Javascript:unloadEvent()">   
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

     $sql="SELECT min(cycle) as cycle FROM WAREHOUSE.history WHERE created_at > ? 
     AND created_at < ?";
     $cycle_crit_fields1 ="'2019-06-11 00:00:00'";
     $cycle_crit_fields2="'2019-06-11 23:00:00'";
     $cycle_number=0;
     $datacontainer=$data_prod->get_RS($sql,$cycle_crit_fields1,$cycle_crit_fields2);

     $cycle_number=$datacontainer[0][0]+1; 
           
     print " <p class='text'>New Cycle Number:" .$cycle_number. "</p><br>";
     $_SESSION["iee_id"]=$cycle_number;
    

     /*Hier muss noch Ajax eingefuegt werden das heisst wenn der user die line scannt wird der text ausgetausch*/



?>
<table border="0" align="center">
  <tr>
    <td colspan="1">
      <input type="text" id="textscanstation" style="width:98%;height:32px; text-align:center" value="Please scan the Workstation">
    </td>
  </tr>
  <tr>
    <td colspan="1">
      <input type="text" id="scan_data" style="width:98%;height:32px; text-align:center" value="Get Scanned data here">
    </td>
  </tr>
  <tr>
    <td align="center">
      <form>
       <textarea id="items_scan" rows="6" style="display:none;" cols="50"></textarea> 
       <input type="submit"  class='input-btn' value="Upload">
      </form>

    </td>
  </tr>
  <tr> 
    <td align="center">
       <button class="input-btn" onClick="test()" >Clear</button>
       <input type="text" id="receive_data" style="width:98%;height:32px; text-align:center" value="0">
    </td>  
  </tr>  
</table>
</body> 

</center>


</html>
