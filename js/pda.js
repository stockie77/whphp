

function delItem()
{
  alert("nee");
}



function scanReceived(params)
             {
              try{  

                if(params['data']== "" || params['time']=="")
                  {
                      document.getElementById('display').innerHTML = "Failed!";
                      return;
                  }

                  //var displayStr = "Barcode Data: " +params['data']+"<br>Time: "+params['time'];
                  //document.getElementById("display").innerHTML = displayStr;
                  // window.location="start_milkrun.php?name="+params['data'];
          				 if (params['data'].substring(0,3)=='551')// || params['data'].substring(0,3)=='000') 
          				 {
          					//window.location='" .  $_SERVER['PHP_SELF'] . "?fullID=' + params.data.substring(0,10)
                    window.location="http://"+window.location.host+"/pda_index.php?fullID="+params['data'].substring(0,10);
          					//alert(params['data'].substring(0,10));
                    return;
          				 }
                   else
                   {
                     url=document.URL;
                     pos_php=url.indexOf("php");
                     pos_slash=url.lastIndexOf("/");
                     window_name=url.substring(pos_slash+1,pos_php-1);
                     

                     if (window_name=="order")
                        {
                          listitems=document.getElementById("items_scan").value;
                          line_info=document.getElementById("textscanstation").value;
                        //  alert(line_info);
                          
                           //if line textscanstation include 'Workstation'  and scanned data are supply line 
                          if (params['data'].indexOf("SP")!=-1 && line_info.indexOf("Workstation")!=-1)
                          {
                            document.getElementById("textscanstation").value = params['data'];
                            document.getElementById("items_scan").value=listitems+";"+params['data']; 
                            document.getElementById('receive_data').value=0;
                          }
                          //if line textscanstation include supply line  and scanned data are supply line 
                          else if (params['data'].indexOf("SP")!=-1 && line_info.indexOf("-")!=-1)
                          {
                            document.getElementById("textscanstation").value = params['data'];
                            document.getElementById("items_scan").value=listitems+";"+params['data']; 
                            document.getElementById('receive_data').value=0;
                          }
                          //if textscanstation
                          else if (line_info.indexOf("Workstation")==-1 && line_info.indexOf("-")!=-1)
                          {
                            
                           if (CheckBarcode_iee(params['data'])==true)
                           {

                            if (checkBarcodeChecksum(params['data'])==true)
                            {
                                document.getElementById("scan_data").value=params['data'];
                               
                                document.getElementById("items_scan").value=listitems+";"+params['data'];   
                                count_items=parseInt(document.getElementById('receive_data').value)+1;  

                                document.getElementById('receive_data').value=count_items;                       

                            }
                            else
                            {

                              alert ("Checksum wrong!")
                            }


                           }
                           else
                           {
                            alert ("Barcode not supported!")
                           }
                            

                          }
                          /*
                          else if (document.getElementById("textscanstation").value!="")
                          {
                            alert("Scan firt the Supplypoints!");
                          }

*/
                          //document.getElementById("display_line").value = params['data'];
                          //document.getElementById("textscanstation").value="Scan Material";
                          
                        }
                        else if (window_name=="sap")
                        {
						   listitems=document.getElementById("items_scan").value;
						   if (CheckBarcode_SAP_LOC(params['data'])==true)
						   {							   
							
							if (document.getElementById('source_loc').value=="" && document.getElementById('dest_loc').value=="")
							{
								
								document.getElementById('source_loc').value=params['data'];
								
							}
							//if source 
							else if (document.getElementById('source_loc').value!="" && document.getElementById('dest_loc').value=="")
							{
								$source=document.getElementById('source_loc').value;
								
								$erg=$source.includes(params['data']);
								
								if ($erg==false)
								{
									
									path="";
									
									$barcode=document.getElementById('items_scan').value
									if ($barcode!="")
										{
											source_loc=document.getElementById('source_loc').value;
											
				
											$barcode2=document.getElementById('source_loc').value+$barcode+";"+params['data'];
											path="http://"+window.location.host+"/process.php?items_scan="+$barcode2;
											window.location=path;
										}
										else {alert("No value scanned!");}
								}
								else{alert("Source and Destination must be different!");}
								
								
							}
							
						   }
						   else
						   {
                            if (checkBarcodeChecksum(params['data'])==true && document.getElementById('source_loc').value!="")
                            {
                                document.getElementById("scan_data").value=params['data'];
                               
                                document.getElementById("items_scan").value=listitems+";"+params['data'];   
                                count_items=parseInt(document.getElementById('receive_data').value)+1;  

                                document.getElementById('receive_data').value=count_items;                       

                            }
                            else if (checkBarcodeChecksum(params['data'])==true && document.getElementById('source_loc').value=="")
                            {

                              alert ("Scan first Source!");
                            }

							   
						   }
					
					   
                        }                        

                   }

          				 
      
               }
               catch(err)
               {
                    alert(err)
               } 

             }

function loadEvent(){
                EB.Barcode.enable({allDecoders:true}, scanReceived);


            }

function unloadEvent(){
                 EB.Barcode.disable();
            }
function removeItems_memo(object)
{
	try{
		document.getElementById(object).value="";
		
		}
   catch(err)
               {
                    alert(err);
               }  		
}



function removeItems()
{
try{ 
   var workstation = document.getElementById('textscanstation').value;
   var scanitems = document.getElementById('items_scan').value;
  
  // alert(scanitems);
   first_pos_line=scanitems.indexOf("S");
  // alert(scanitems.substring(first_pos_line,scanitems.length));
   str=scanitems.substring(first_pos_line,scanitems.length);
   fields_scanitems=str.split(";");
   
   if (fields_scanitems.length>1)
   {
        var line_array = [];
        var items_array=[];
        var count_lines=0;
        var count_total_items=0;
        for (x=0;x<fields_scanitems.length;x++)
            {
              
              erg=fields_scanitems[x];
              //find and count all lines in the string 
              if (erg.indexOf('SP')!=-1)
              {
                count_lines++;
                zeiger=x;
                line_array[count_lines]=fields_scanitems[x];
                items_array[count_lines]=x;
                //alert(fields_scanitems[x]);
              }

            }
            if (count_lines>1)
            {
              //line now the previous line (-1)
             line=line_array[count_lines-1]; 
            }
            else
            {
                line="Please scan the Workstation";
                line_array[0]=0;
            }
        //alert(items_array[count_lines-1]);
        //alert(zeiger);    
        count_total_items=0;
        for (i= parseInt(items_array[count_lines-1]);i<zeiger;i++)
        {
          count_total_items++;

        }

        //
        document.getElementById('textscanstation').value=line;    
        document.getElementById('items_scan').value="";    
        document.getElementById('scan_data').value="Get Scanned data here";
        //document.getElementById('receive_data').value=0;
        
        if (zeiger>1)
        {
          //after clear the memo box items_scan add all item until to the previous line
          for (x=0;x<zeiger;x++)
              {
                //alert(fields_scanitems[x]);
              //  alert(document.getElementById('items_scan').value);
                document.getElementById('items_scan').value=document.getElementById('items_scan').value+";"+fields_scanitems[x];
                document.getElementById('receive_data').value=count_total_items-1;
              }   
        }
        else 
        {
          
          document.getElementById('items_scan').value="";
          document.getElementById('receive_data').value=0;

        }
      }  
      alert(document.getElementById('items_scan').value);  

   }
   catch(err)
               {
                    alert(err);
               }  
}

function test()
{
  alert("test");
}




function addCommas(input){
    input = input.replace(/,/g , "");
    var res = input.match(/.{1,2}/g);

    return res.join(",");
}

function addCommasToElement(elementId) {
    var element = document.getElementById(elementId);
    var currentVal = element.value;
    element.value = addCommas(currentVal);
}

function clearValue(elementId) {
    var element = document.getElementById(elementId);
    element.value = "";
}

function checkBarcodeChecksum(barcode) {
    var isValid = true;
    var barcodeLen = barcode.length;
    if (barcodeLen > 2) {
        var barcodeWOChecksum = barcode.substring(0, barcode.length - 2);
        var checksum = parseInt(barcode.substring(barcode.length - 2));
        if (modulo(barcodeWOChecksum, 97) !== checksum) {
            alert('the checksum is wrong! Scanned:\n ' + barcode);
            isValid = false;
        } else {
            localStorage.setItem("lastScannedBarcode", barcode);
        }
    }
    return isValid;
}

//https://stackoverflow.com/questions/929910/modulo-in-javascript-large-number
function modulo(divident, divisor) {
    var partLength = 10;
    while (divident.length > partLength) {
        var part = divident.substring(0, partLength);
        divident = (part % divisor) +  divident.substring(partLength);
    }
    return divident % divisor;
}




    function showBatteryIcon(){
            EB.Battery.showIcon(defineIconProperties(), batteryCallback);
            EB.Battery.batteryStatus({trigger:EB.Battery.BATTERY_TRIGGER_SYSTEM}, batteryCallback);
            // The batteryStatus() is used to tell the icon when to refresh.
            // We are leaving this up to the system events by using the BATTERY_TRIGGER_SYSTEM constant.
        }

    function hideBatteryIcon(){
            EB.Battery.hideIcon();
            EB.Battery.stopBatteryStatus();
        }

    function batteryCallback(params){
            if(params){     // Most of these methods have callbacks but null 'params' sent.
                console.log(params);
            }
            else
                console.log("No Params");
        }

    function defineIconProperties(){
            var props = {
                color:  "#66CD00",
                layout: EB.Battery.BATTERY_LAYOUT_RIGHT,
                top:        window.innerHeight-30,  
                 
                left:   EB.System.screenWidth +90      // Far right of screen, accounting for actual viewable area.
            }
            return props;
        }

    function adjustIcon(){
            EB.Battery.hideIcon();
            EB.Battery.showIcon(defineIconProperties(), batteryCallback);
        }

        // If the screen orientation changes, adjust the battery Icon.
    EB.ScreenOrientation.setScreenOrientationEvent(adjustIcon);

   /*
    
    var lastBarcode = localStorage.getItem("lastScannedBarcode");
    if (lastBarcode.toString() !== 'null') {
        document.write("<br><br><hr><center><p class='text'> Last scanned valid barcode: <br>" + lastBarcode + "</p></center><hr>");
    }
    */

function CheckBarcode_iee(str)
{
    
    var Barcodeident=new Array()
    var count_barcode_fields=30
    //Ident
    
    Barcodeident[3]=new Array(count_barcode_fields)
    Barcodeident[3][0]='20000';
    Barcodeident[3][1]='551';
    Barcodeident[3][2]='42';   
    Barcodeident[3][3]='56';
    Barcodeident[3][4]='56';
    Barcodeident[3][5]='40';
    Barcodeident[3][6]='40';
    Barcodeident[3][7]='40';
    Barcodeident[3][8]='41'; 
    Barcodeident[3][9]='57';
    Barcodeident[3][10]='43';
    Barcodeident[3][11]='44';
    Barcodeident[3][12]='552';
    Barcodeident[3][13]='40';
    Barcodeident[3][14]='7';
    Barcodeident[3][15]='7';
    Barcodeident[3][16]='41';
    Barcodeident[3][17]='40';
    Barcodeident[3][18]='12';
    Barcodeident[3][19]='5';
    //Model A,B,GenT
    Barcodeident[3][20]='40';
    Barcodeident[3][21]='40';
    Barcodeident[3][22]='40';
    Barcodeident[3][23]='7';
    //Anbruchkisten
    Barcodeident[3][24]='5';
    Barcodeident[3][25]='41';
    //Altes Fert
    Barcodeident[3][26]='7'
    Barcodeident[3][27]='7';
    //Pickinglist
    Barcodeident[3][28]='57';
    Barcodeident[3][29]='45';


    //Seats and equipment
   // Barcodeident[3][26]='1';
   // Barcodeident[3][27]='2';
   // Barcodeident[3][28]='3';
   // Barcodeident[3][29]='4';
   // Barcodeident[3][30]='5';
   // Barcodeident[3][31]='6';
    
    //Length Barcode
    var Barcodelength= new Array();
    Barcodelength[1]=new Array(count_barcode_fields)
    Barcodelength[1][0]=10;
    Barcodelength[1][1]=10;
    Barcodelength[1][2]=14;   
    Barcodelength[1][3]=14;
    Barcodelength[1][4]=24;
    Barcodelength[1][5]=30;
    Barcodelength[1][6]=28;
    Barcodelength[1][7]=22;
    Barcodelength[1][8]=30; 
    Barcodelength[1][9]=18;
    Barcodelength[1][10]=14;
    Barcodelength[1][11]=22;
    Barcodelength[1][12]=12;
    Barcodelength[1][13]=32;
    Barcodelength[1][14]=24;
    Barcodelength[1][15]=26;
    Barcodelength[1][16]=44;
    Barcodelength[1][17]=38;
    Barcodelength[1][18]=14;
    Barcodelength[1][19]=26;
    //Model A,B,GenT
    Barcodelength[1][20]=40;
    Barcodelength[1][21]=40;
    Barcodelength[1][22]=40
    Barcodelength[1][23]=28;
    Barcodelength[1][24]=28;
    Barcodelength[1][25]=46;
    Barcodelength[1][26]=22;
    Barcodelength[1][27]=34;
    Barcodelength[1][28]=40;
    Barcodelength[1][29]=34;


    //Seats and equipment
   // Barcodelength[1][26]=str.length;
   // Barcodelength[1][27]=str.length;
   // Barcodelength[1][28]=str.length;
   // Barcodelength[1][29]=str.length;
   // Barcodelength[1][30]=str.length;
   // Barcodelength[1][31]=str.length;

//Checksum 
    var Barcodechecksum =new Array
    Barcodechecksum[2]=new Array(count_barcode_fields)
    Barcodechecksum[2][0]=0;
    Barcodechecksum[2][1]=0;
    Barcodechecksum[2][2]=1;   
    Barcodechecksum[2][3]=0;
    Barcodechecksum[2][4]=1;
    Barcodechecksum[2][5]=1;
    Barcodechecksum[2][6]=0;
    Barcodechecksum[2][7]=0;
    Barcodechecksum[2][8]=1; 
    Barcodechecksum[2][9]=0;
    Barcodechecksum[2][10]=1;
    Barcodechecksum[2][11]=1;
    Barcodechecksum[2][12]=1;
    Barcodechecksum[2][13]=1;
    Barcodechecksum[2][14]=0;
    Barcodechecksum[2][15]=1;
    Barcodechecksum[2][16]=1;
    Barcodechecksum[2][17]=1;
    Barcodechecksum[2][18]=1;
    Barcodechecksum[2][19]=1;
    //Model A,B,GenT 
    Barcodechecksum[2][20]=0;
    Barcodechecksum[2][21]=0;
    Barcodechecksum[2][22]=0;
    Barcodechecksum[2][23]=0;
    Barcodechecksum[2][24]=0;
    Barcodechecksum[2][25]=0;
    Barcodechecksum[2][26]=0;
    Barcodechecksum[2][27]=0;
    Barcodechecksum[2][28]=0;
    Barcodechecksum[2][29]=0;
    //Seats and equipment
   // Barcodechecksum[2][26]=0;
   // Barcodechecksum[2][27]=0;
   // Barcodechecksum[2][28]=0;
   // Barcodechecksum[2][29]=0;
   // Barcodechecksum[2][30]=0;
   //Barcodechecksum[2][31]=0;
    var seat_barcode=false;
    var bindestrich_barcode=false;
    var bindestrich_anz=0;
    var feld_inhalt="";

    for (x=0;x<str.length;x++)
        {

            if (str.substring(x,x+2)=="__")
                {
//                    document.write(str.substring(x,x+2))
                    //document.write(str.search("xx"))
                    seat_barcode=true;
                } 
             else if (str.substring(x,x+1)=="-")  
                {
                    //alert(str.substring(x,x+1))
                    bindestrich_anz=bindestrich_anz+1;

                    bindestrich_barcode=true;
                }
                
        }
    if (bindestrich_barcode==true)
    {
      if (bindestrich_anz==3)
      {
        felder=str.split("-");
        feld_inhalt=felder[0];
        if (feld_inhalt.length<4)
        {
          bindestrich_barcode=false;
        }
      }

    }    

    var iee_barcode=false;
    var strLength;


    for (i=0;i<count_barcode_fields;i++)
    {
        
       if ((str.length==Barcodelength[1][i]) || (seat_barcode==true) || (bindestrich_barcode==true))
         {   
         
                iee_barcode=true;
              
                ident=Barcodeident[3][i];

                if ((str.substring(0,ident.length)==ident) || (str.search("__")!=-1)||(str.search("-")!=-1))
                
                {
                    
                            return(true);

                }
                
          }
          
    } 

	
    if (iee_barcode==false){return(false)}
       
}



function CheckBarcode_SAP_LOC(str)
{
   // alert("Eingang SAP Check")
    var Barcodeident=new Array()
    //count_barcode_fields +1
    var count_barcode_fields=21
    Barcodeident[15]=new Array(count_barcode_fields)
    Barcodeident[0]='WAREHOUSE';
    Barcodeident[1]='PRODUCTION';
    Barcodeident[2]='BLOCKED STOCK';
    Barcodeident[3]='SPARE PARTS';
    Barcodeident[4]='TEXAS';
    Barcodeident[5]='WEILERBACH';
    Barcodeident[6]='COSMOLUX';
    Barcodeident[7]='OBSOLETE';
    Barcodeident[8]='MAINTANANCE';
    Barcodeident[9]='CONTERN'
    Barcodeident[10]='MD CONTERN'
    Barcodeident[11]='COLLECTOR PRINT'
    Barcodeident[12]='HR DEPARTMENT'
    Barcodeident[13]='PROTOTYPE'
    Barcodeident[14]='INCOMING'
    Barcodeident[15]='PRINTSHOP'
    Barcodeident[16]='SHIPPING'
    Barcodeident[17]='CAMERA'
    Barcodeident[18]='SHELF LIFE'
    Barcodeident[19]='PROTOTYPE'
    Barcodeident[20]='KLTBOXES'


    var sap_barcode=false;
    for (i=0;i<count_barcode_fields;i++)
    {
         
                ident=Barcodeident[i];


                 if (str.search(ident)!=-1)
                     {
                      
                         sap_barcode=true;
                         break;

                     }
          

    }

    return sap_barcode;

}