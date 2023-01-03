
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

require 'functions.php';

date_default_timezone_set("Europe/Helsinki");

$response=file_get_contents('http://assignments.reaktor.com/birdnest/drones'); //reading a file into a string 
$report = new SimpleXMLElement($response); //getting XML data
$data=$report->capture;
$time=$report->capture['snapshotTimestamp'];
$a = new \DateTime("$oldtime");
$time = $a->format('Y-m-d H:i:s');//setting the time variable in the right format
$time=date('Y-m-d H:i:s');

foreach ($data->children() as $drone){

    //setting the variables
    $x=$drone->positionX; //X coordinate of a drone
    $y=$drone->positionY; //Y coordinate of a drone
    $cSquared=((250000-$x)*(250000-$x))+((250000-$y)*(250000-$y));
    $c=sqrt($cSquared); 
    $SN=$drone->serialNumber;//serial number 
    
    if ($c<=100000){ // if the distance is smaller  or equal than 100000, the drone is in the NDZ

        $url = "http://assignments.reaktor.com/birdnest/pilots/$SN";
        $json = file_get_contents($url);
        $obj=json_decode($json,true);
        // reading and decoding json string

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
               
            } //setting the variables from the Json file 
            
        }
        //function to insert data into the database, updating position if smaller than previous, always updating the time 
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
// funcrion deleting data older than 10 minutes from the database
sqlDelete(
    "drone",
    "NOW()-INTERVAL 10 MINUTE"
    
);
//function printing the table with list of pilots names, email, phone number and distance of the drone
printTable(
    "drone",
    "timedate,Firstname, Lastname, email, phonenumber,position"
);
//function counting and showing the shortest distance of the drones in the database
closestDistance(
    "drone"
   
);

?>

</body>
</html>
