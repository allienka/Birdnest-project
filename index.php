
<html>
<head>
<meta http-equiv="refresh" content="600" > 
<style>
    <?php include('mystyle.css')?>
</style>
<h1>Drones in NDZ</h1>

</head>
<body>    
<?php

require 'function.php';

date_default_timezone_set("Europe/Helsinki");

$response=file_get_contents('http://assignments.reaktor.com/birdnest/drones');
$report = new SimpleXMLElement($response);
$data=$report->capture;
$time=$report->capture['snapshotTimestamp'];
$a = new \DateTime("$oldtime");
$time = $a->format('Y-m-d H:i:s');
$time=date('Y-m-d H:i:s');

foreach ($data->children() as $drone){
    $x=$drone->positionX;
    $y=$drone->positionY;
    $cSquared=((250000-$x)*(250000-$x))+((250000-$y)*(250000-$y));
    $c=sqrt($cSquared);
    $SN=$drone->serialNumber;
    
    if ($c<=100000){

        $url = "http://assignments.reaktor.com/birdnest/pilots/$SN";
        $json = file_get_contents($url);
        $obj=json_decode($json,true);
        

        foreach ($obj as $key=>$value){
            if ($key=="firstName"){
                $firstname=$value;
            
            }if ($key=="lastName"){
                $lastname=$value;
                if (strpos(($lastname),"'") !==false ){
                    $lastname=str_replace("'","''",$lastname);
                }
                
            }if ($key=="email"){
                $email=$value;
                if (strpos(($emai),"'") !==false){
                    $email=str_replace("'","''",$email);
                }
                
            }if ($key=="phoneNumber"){
                $phonenumber=$value;
               
            }
            
        }
        
        sqlInsertUpdate(
            "drone", 
            "Serialnumber, Firstname, Lastname, email, phonenumber, position, timedate", 
            "'$SN','$firstname','$lastname', '$email', '$phonenumber','$c','$time'",
            "position",
            "$c",
            "timedate",
            "$time"
        );
        
    }    

}

sqlDelete(
    "drone",
    "NOW()-INTERVAL 10 MINUTE"
    
);
printTable(
    "drone",
    "Firstname, Lastname, email, phonenumber"
);
closestDistance(
    "drone"
   
);

?>

</body>
</html>
