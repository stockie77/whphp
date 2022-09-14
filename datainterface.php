




<?php


	class databases{
		const konstante="databases";
        public $data_array=array();
        public $db;

		public function getConst()
		{
			return self :: konstante;
		}




        public  function __construct($hostname,$db_name,$db_username,$db_password,$port)
        {
            try{
                   # $this->db = db2_connect($db_name, $db_username, $db_password);
		$driver  = "DRIVER={IBM DB2 ODBC DRIVER};";
		$dsn     = "DATABASE=$db_name; " .
           	"HOSTNAME=$hostname;" .
           	"PORT=$port; " .
           	"PROTOCOL=TCPIP; " .
          	"UID=$db_username;" .
          	"PWD=$db_password;";
		$conn_string = $driver . $dsn;     # Non-SSL

		# Connect
		#
		    $this->db = db2_connect( $conn_string, "", "" );

                    if (!$this->db)
                    {
                         print db2_conn_errormsg();
                    }
                    else
                    {
                        return $this->db;
                    }
                }
                 catch (Execption $e)
                {
                   error_log($e);
                }
        }




        public function get_RS2($insert,$value_array)
        {
            try{
                $stmt = db2_prepare($this->db, $insert);


                if ($stmt)
                    {
                            $result = db2_execute($stmt, $value_array);
                            if ($result)
                            {
                                $zaehler=0;
                                while ($row = db2_fetch_array($stmt))
                                {
                                    print  $stmt;
                                    $this->data_array[] = $row;

                                }
                             }
                            else
                             {
                                print db2_stmt_errormsg();
                                error_log(db2_stmt_errormsg());
                             }

                    }
                    else
                        {

                            print db2_stmt_errormsg();
                            error_log(db2_stmt_errormsg());
                            return false;
                        }
                    db2_close($this->db);
                    return $this->data_array;
                }
                catch (Execption $e)
                {
                   error_log($e);
                }
        }

        public function modify_RS($insert,$value_array)
        {
            try{

                    $stmt = db2_prepare($this->db, $insert);
                    error_log("eingang modify_RS");

                    if ($stmt)
                        {
                            $result = db2_execute($stmt, $value_array);
                            if ($result)
                            {

                            return true;

                            }
                            else
                            {

                                print db2_stmt_errormsg();
                                error_log(db2_stmt_errormsg());
                                return false;
                            }


                        }
                        else
                            {

                                print db2_stmt_errormsg();
                                error_log(db2_stmt_errormsg());
                                return false;
                            }
                        db2_close($this->db);
                }
                catch (Execption $e)
                {
                   error_log($e);
                }


        }




        public function get_RS($sql,$params1)
        {

            try{

                	$stmt = db2_exec($this->db,$sql);
                     /*   */
                    $params_in1=$params1;

                    if ($stmt)
                    {
                      //  echo "Statment laueft<br>";


                        $erg=db2_fetch_assoc($stmt);
                        if ($erg)
                        {
                            $zaehler=0;
                            while ($row = db2_fetch_array($stmt))
                            {

                                $this->data_array[] = $row;

                            }
                         }
                        else
                         {
                            print db2_stmt_errormsg();
                            error_log(db2_stmt_errormsg());
                         }



                    }
                    else
                    {
                        print db2_stmt_errormsg();
                        error_log(db2_stmt_errormsg());
                    }

                    db2_close($this->db);
                    return $this->data_array;
                }
                catch (Execption $e)
                {
                   error_log($e);
                }

        }



        public static function closeConnection($conn)
        {
           #db2_close($this->db);
	   db2_close($conn);
        }


	}



?>
