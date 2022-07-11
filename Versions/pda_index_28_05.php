  

    <body onload="loadEvent()" onunload="Javascript:unloadEvent()">
        <center>
            <?php include_once "templates/header.phtml" ?>
            <div style="background-color: white">
            <h1>Login</h1>
            </div>
        <h4>Please scan your batch card!</h4>

        <hr>

        <button class="input-btn" onClick="EB.Application.quit()">Close App</button>

        </center>

         <?php
            session_start();
            extract($_REQUEST, EXTR_SKIP);        
            global $fullID;
                
            if(!isset($fullID)) $fullID=0;
     
            if($fullID) 
            {  

               // $db_prod="proddbe";
                $db_Data="DB2_DATA";
                $user = "";
                $password = "";   
                
                include('datainterface.php');
               // echo "datainterface";
                $data_prod=new databases($db_Data, $user, $password);
                $sql="Select * from DB2_TRANS.IEEUSER where IEE_ID=?";


                /*
                "SELECT
                    TESTER.IEEUSER.USER_ID,
                    TESTER.IEEUSER.FIRSTNAME,
                    TESTER.IEEUSER.SURNAME,
                    TESTER.IEEUSER.IEE_ID
                FROM
                    TESTER.APPS
                INNER JOIN
                    TESTER.APPUSER
                ON
                    (TESTER.APPS.APPID = TESTER.APPUSER.APPID)
                INNER JOIN
                    TESTER.IEEUSER
                ON
                    (TESTER.APPUSER.USER_ID = TESTER.IEEUSER.USER_ID)
                WHERE
                    TESTER.APPS.APPID = 3
                    AND TESTER.IEEUSER.OUTDATE IS NULL
                    AND TESTER.IEEUSER.IEE_ID = ?"
                ;
                
                */

              $datacontainer=$data_prod->get_RS($sql,$_GET['fullID']);
              /* 
             
              foreach ($datacontainer as $erg) 
                {
                    echo "Ausgabe Tester \n";
                  //  foreach ($erg as $key ) {
                   //      echo $key;
                   //  }
                   echo $erg; 
                   ++$zaehler;
                }
              */ 
                
              
                
              if (count($datacontainer)>0)
              {

                $_SESSION["user_name"] =$datacontainer[0][2];
                $_SESSION["user_id"] = $datacontainer[0][0];
               // echo erg[2];
                //echo "test";
                header("Location:mode.php");
              }
              else
              {
                $message = "The user ID " . $fullID . " was not found in database";
              }
              
            }

        ?>


         <?php 
            if($message!="") { 
                echo "<center><p class='text'>" . $message . "</p></center>";
            }
         ?>   




    </body>
