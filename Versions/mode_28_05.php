<?php
session_start();
extract($_REQUEST, EXTR_SKIP);
?>
<html>
    <?php include_once "templates/header.phtml" ?>
        <center>
            <h1>Work mode</h1>
<?php if ($_SESSION["user_name"]) { ?>
    <p class="text">CURRENT USER: <?= $_SESSION["user_name"] ?> </p>
    <form action='pda_index.php'>
        <input type='submit' class='input-btn' value='Logout'>
    </form>
    <hr>
<?php } else 
    {
        header("Location:pda_index.php");
    } 
  ?>
    <table>
        <tr>
            <td>
                <form action="tool_administration.php">
                    <input type="submit" class="input-btn" value="Tool administration">
                </form>
            </td>
            <td>
                <form action="page4.php">
                    <input type="submit" class="input-btn" value="Print area">
                </form>
            </td>
        </tr>

    </table>
</center>

<?php include_once "templates/page_end.phtml" ?>
</html>