<html>
    <head>
            <link rel="stylesheet" href="/public/css/pda.css" type="text/css">
        <script type="text/javascript" charset="utf-8" src="/public/javascripts/ebapi-modules.js"></script>
        <script type="text/javascript" charset="utf-8" src="/public/javascripts/pda1.js"></script>

        <script type="text/javascript">

            window.addEventListener('DOMContentLoaded', loadEvent);
            window.addEventListener('unload',unloadEvent);
        </script>     
    </head>

    <body onload="loadEvent()" onunload="Javascript:unloadEvent()">

        <h1>Scan your ID Card</h1>
        <h2>Vers 1.2</h2>
        Scan a barcode.<br><br><br>
        <div id="display">
        Barcode Data: <br>
        Time:
        </div><br>


         <form action="start_milkrun.php" method="get">
            Name: <input type="text" name="name"><br>
            <input type="submit">
        </form>    
    </body>

        /*
        $sql = 'SELECT * from TESTER.IEEUSER WHERE USER_ID =?';
        $datacontainer=$data->get_RS($sql,$sql);
        echo "  init datacontainer";
        
        foreach ($datacontainer as $erg) 
        {
            echo "Ausgabe Tester \n";
            print $erg[1];

        }


        $sql = 'SELECT * from WAREHOUSE.USERS WHERE USER_ID =?';
        $data_proddbe=$data->get_RS($sql,$sql);
        
        echo "  init datacontainer";
        
        foreach ($data_proddbe as $erg) 
        {
            echo "Ausgabe \n";
            print $erg[0];

        }
        
        
        //barcode,batch_of_lots,quantity,memo,box_num,
        $warehouse_batch_ds = array('70127700056200708111111', '111111', 560,'2007081321004','4711',1,0,3040575,'01277000562');
        $insert = 'INSERT INTO WAREHOUSE.warehouse_batches (barcode,batch_of_lots_id,quantity,memo,box_num,consi,transfer,ID,mat_nr)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        print "Einfuegen DS";
    //    $erg=$data->insert_RS($insert,$warehouse_batch_ds);
        print "//";
        echo $erg;

        */
</html>
