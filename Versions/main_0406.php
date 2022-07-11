<?php
session_start();
extract($_REQUEST, EXTR_SKIP);
?>
<html>
    <?php include_once "templates/header.phtml" ?>
        <center>
            <h1>Main Menu</h1>
 
<head>
  

</head>    
<?php if ($_SESSION["user_surename"]) { ?>
    <p class="text">CURRENT USER: <?=$_SESSION["user_surename"]?> </p>
    <p class="text">Mode <?=$_GET['mode']?> </p>
     <form action='pda_index.php'>
        <input type='submit' class='input-btn' value='Logout'>
    </form>

<?php } else 
    {
        header("Location:pda_index.php");
    } 
  ?>

<?php
    echo "mode";
    $modus=$_GET['mode'];
    echo "Modus". $modus."<br>";
    $num_IEEID=(int)substr($_SESSION["iee_id"],-6);
    echo "IEE ID ".$_SESSION["iee_id"]. "<br>";
  //   $sqlQuery = "UPDATE ".TB_NAME." SET ".CN_NAME." = ? WHERE DAY = ?";  
?>
 

</center>

<?php include_once "templates/page_end.phtml" ?>
</html>