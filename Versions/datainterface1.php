




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
        }

        public function get_RS($sql,$params)
        {
            //$count=0;

        	$stmt = db2_prepare($this->db, $sql);  
             /*   */
            if ($stmt)
            {
                $erg=db2_execute($stmt);
                if ($erg)
                {
                 while ($row = db2_fetch_array($stmt))
                 {  
              
                    $this->data_array[] = $row;
                 } 
                
                }
              
            }
            db2_close($this->db);
            return $this->data_array;
            
           
            
            
         //   return db2_fetch_object($stmt) 
        }


/*

        public static function closeConnection($conn)
        {
            $this->db.close();
        }

    */
	}



?>