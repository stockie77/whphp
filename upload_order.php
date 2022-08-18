

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
