<?php

include 'datainterface.php';

$dbhost = 'luechdb61.iee.intern';#luechdbieewhmprod.iee.intern
$dbuser = 's_whm';
$dbpass = '9h29T91oF9TyDjnGpOqY';
$port = 62010; #62210
$dbname = 'IEEWHM';


#db_name,$db_username,$db_password,$port)


$db=new databases($dbhost,$dbname,$dbuser,$dbpass,$port);
#$batch_id = $_POST['batch_id'];
#sum=
$execute =$_POST['sql_para'];
#$insert="insert into warehouse.matnr_maxunit(id,mat_nr,units)values(70,'$batch_id',4)";
#$update="update warehouse.warehouse_batches set booked=0,total_sum=0,order_no=0,cycle=0,move_status='' where id=".$batch_id

$db->modify_RS($execute,array(0));

#$text = $_POST['batch_id'];

#echo "ergebnis" .$text;

exit;

?>
