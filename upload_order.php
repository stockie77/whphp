<html>

<head>
  <meta charset="utf-8">
  <title>Picking List</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"> </script>
  <link rel="stylesheet" href="css/style.css">
</head>
<h1>Picking List Warehouse</h1>
</body>

  <section id="navbar">
     <nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-with-menu bg-light py-0">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand mx-auto" id="logo" href="/"><img border="0" src="assets/IEE_logo.png" width="80" height="40" /></a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-2">
      <li class="nav-item">
        <a class="nav-link nav-search-link" href="/warehouse_batches/search">SEARCH</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link nav-dropdown-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          REPORTS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="nav-link dropdown-item font-weight-bold font" href="/warehouse_batches/expire">Expired</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/warehouse_batches/on_stock">On Stock</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/warehouse_batches/inventory">Inventory</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/histories">History</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link nav-dropdown-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LIST
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="nav-link dropdown-item font-weight-bold" href="/warehouse_batches/lot_to_store">Lot to Store</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/warehouse_batches/blocked">Blocked Stock</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/warehouse_batches/empty_location">Empty Location</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link nav-dropdown-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          EXTRAS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="nav-link dropdown-item font-weight-bold" href="/admins/auth">Admin</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/exception_list">Exception List</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/wh_to_prod">Request WH to PROD</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/delivery_list">Ordered/Delivered</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/wh_to_sm">List WH to SM</a>
          <a class="nav-link dropdown-item font-weight-bold" href="/sm_to_wh">List SM to WH</a>
        </div>
      </li>
    </ul>
  </div>
  </section>

<?php

include 'datainterface.php';

class upload_order
{
public $dbhost = 'luechdbieewhmprod.iee.intern';#'luechdb61.iee.intern';
public $dbuser = 's_whm';
public $dbpass = '9h29T91oF9TyDjnGpOqY';
public $port = 62210;#62010;
public $dbname = 'IEEWHM';


#db_name,$db_username,$db_password,$port)
public $db;


#foreach ($fields as $field) {
#        echo $field[1] . '<br>';
#}


public function main($sql)
	{
		try
		{
			echo $this->dbhost;
			$this->db= new databases($this->dbhost,$this->dbname,$this->dbuser,$this->dbpass,$this->port);
			$fields = $this->db->get_RS($sql,array(0));


			foreach ($fields as $field) {
        			echo $field[1].$field[4].$field[7].$field[8].$field[9].$field[14]. '<br>';
	   		}
	  	}catch(Exception $e)
   	   	{
        		echo 'Caught exception: ',  $e->getMessage(), "\n";
   	   	}
	}

}

$obj=new upload_order;
$sql="select 0 as zaehler,case when B.supermarket='1' then 'SM' else 'WH' end  as bin_status_desc,W.description,max(barcode) as barcode,(Left(W.mat_nr,2)||'-'||case when
CHAR_LENGTH(W.mat_nr)=12 then trim(Substr(W.mat_nr,3,6)) else Substr(W.mat_nr,3,11) end||'-'||case when CHAR_LENGTH(W.mat_nr)=12 then Substr(W.mat_nr,9,2) else Substr(W.mat_nr,14,2) end||'-'||Right(W.mat_nr,2)) mat_nr,BL.id lot,count(W.id) as HU,W.quantity,(A.aisle_num||'-'||R.rack_num||'-'||R.level||'-'||B.bin_num) as location,max(W.memo) as memo,M.modelname,W.total_sum,W.prod_line,M.modelname,W.mode_delivery,W.quantity  from  warehouse.warehouse_batches W left join warehouse.batch_of_lots BL on W.batch_of_lots_id=BL.ID left join warehouse.bins B on BL.BIN_ID=B.ID left join warehouse.bin_statuses BS on BS.id=B.bin_status_id left join warehouse.racks R on B.RACK_ID=R.ID left join warehouse.aisles A on R.AISLE_ID=A.ID left join warehouse.model M on W.mod_id=M.id left join warehouse.stores S on A.Store_ID=S.ID left join warehouse.sites SI on S.Site_ID=SI.ID  where BL.INTRANSIT=0 and W.booked=1  and W.mode_delivery like 'Milkrun%' and W.mode_delivery like 'Milkrun%' GROUP BY BL.id,W.mat_nr,W.quantity,A.aisle_num,R.rack_num,R.level,B.bin_num,W.total_sum,W.prod_line,W.mode_delivery,M.modelname,W.description,B.supermarket,W.memo ". PHP_EOL;


$obj->main($sql);
#show_upload_order($sql);

?>

</body>
</html>
