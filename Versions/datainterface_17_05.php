




<?php
	

	class databases{
		const konstante="databases";
        public $data_array=array();  
        public $db;
       
		public function getConst()
		{
			return self :: konstante;
		}
		

		
        
        public  function __construct($db_name,$db_username,$db_password)
        {
            $this->db = db2_connect($db_name, $db_username, $db_password);
            if (!$this->db) 
            {
				 echo "Error";
                 print db2_conn_errormsg();
            }

        }


/*
        public function insert_RS($insert,$value_array)
        {
            $stmt = db2_prepare($this->db, $insert); 
            $result = db2_execute($stmt, $value_array);
            if ($result) 
                {
                    return true;

                }
                else
                    {return false;}
        }
*/

        public function get_RS($sql,$params)
        {


        	$stmt = db2_prepare($this->db, 'SELECT * from WAREHOUSE.USERS WHERE USER_ID = 963');  
             /*   */
            $params_in='963'; 
            if ($stmt)
            {
                echo "Statment ok\n";
               // db2_bind_param($stmt, 1,"params_in", DB2_PARAM_IN);    
                $erg=db2_execute($stmt);
                if ($erg)
                {
                 while ($row = db2_fetch_array($stmt))
                 {  
              
                    $this->data_array[] = $row;
                 } 
                
                }

              
            }
            else
            {
				echon "Fehler";
                print db2_stmt_errormsg ();
            }

            db2_close($this->db);
            return $this->data_array;

        }


/*

        public static function closeConnection($conn)
        {
            $this->db.close();
        }

    */
	}



?>