<html>
<head>
<meta http-equiv="refresh" content="60" > 
<style>
    <?php include('mystyle.css')?>
</style>
<h1>Drones in NDZ</h1>

</head>
<body>    
<?php

require 'connection.php';
require 'functions.php';
$db=create_dbc();

date_default_timezone_set("Europe/Helsinki");

$XML=getDataFromXML();
$time=getDroneTime($XML);
$data=$XML->capture;
$drones=$data->children();

foreach ($drones as $drone){
    
    $droneData=getDroneData($db,$drone);
    $closeatDistanceInsideNDZ=$droneData[1];
    $SN=$droneData[0];
    
    
    if ($closeatDistanceInsideNDZ<=100000){ // if the distance is smaller  or equal than 100000, the drone is in the NDZ

        $jsonString=readAndDecodeJsonFile($SN,$closeatDistanceInsideNDZ);// reading and decoding json string
         
        foreach ($jsonString as $jstring){
            $pilotData=getPilotData($jsonString);
            $firstname=$pilotData[0];
            $lastname=$pilotData[1];
            $email=$pilotData[2];
            $phonenumber=$pilotData[3];
        }
        
        if(!empty($jsonString)){

            //function to insert data into the database, updating position if smaller than previous, always updating the time 
            insertOrUpdatePilot(
                $db,
                "Serialnumber, Firstname, Lastname, email, phonenumber, position, timedate", 
                "'".mysqli_real_escape_string($db,$SN)."','".mysqli_real_escape_string($db,$firstname)."','".mysqli_real_escape_string($db,$lastname)."','".mysqli_real_escape_string($db,$email)."','".mysqli_real_escape_string($db,$phonenumber)."','".mysqli_real_escape_string($db,$closeatDistanceInsideNDZ)."','".mysqli_real_escape_string($db,$time)."'",
                "position",
                mysqli_real_escape_string($db,$closeatDistanceInsideNDZ),
                "timedate",
                mysqli_real_escape_string($db,$time)
            );
        }
    }
}

// function deleting data older than 10 minutes from the database
cleanupOldPilots($db);

//function printing the table with list of pilots names, email, phone number and distance of the drone
printTable(
    $db,
    "timedate,Firstname, Lastname, email, phonenumber,position"
);
//function counting and showing the shortest distance of the drones in the database
printClosestDistance($db);


close_db($db);
?>

</body>
</html>