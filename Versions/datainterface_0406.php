




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
                 print db2_conn_errormsg();
            }
            else
            {
                return $this->db;
            }

        }



        public function insert_RS($insert,$value_array)
        {
            $stmt = db2_prepare($this->db, $insert); 

            
            if ($stmt) 
                {
                    $result = db2_execute($stmt, $value_array);
                    if ($result)
                    {
                    
                    return true;

                    }
                    else
                    {
                        return false;
                        print db2_stmt_errormsg();
                    }


                }
                else
                    {
                        
                        print db2_stmt_errormsg();
                        return false;
                    }
                db2_close($this->db);    
                    
        }


        public function get_RS($sql,$params)
        {


        	$stmt = db2_prepare($this->db,$sql);  
             /*   */
            $params_in=$params; 
            if ($stmt)
            {
                //echo "Statment laueft\n";
                db2_bind_param($stmt, 1,"params_in", DB2_PARAM_INOUT);    
                $erg=db2_execute($stmt);
                if ($erg)
                {
                    $zaehler=0;
                    while ($row = db2_fetch_array($stmt))
                    {  
                        
                        $this->data_array[] = $row;
                       /* print "Datainterface";
                        print $row[0]; 
                        print "//";
                        
                        print "Datainterface";
                        print $row[0];
                        print $row[1];
                        array_push($this->data_array,$row[$zaehler]);
                        ++$zaehler;
                        */

                    } 
                 }     
                else
                 {
                    print db2_stmt_errormsg();
                 }               
                

              
            }
            else
            {
                print db2_stmt_errormsg();
            }

            db2_close($this->db);
            return $this->data_array;

        }


/*
        public static function closeConnection($conn)
        {
           db2_close($this->db);
        }
*/
  
	}



?>