<?php

//inserting data into the database or update the position and time of the drones that appears again. Position is beeing updated only if the distance is shorter than previous
function insertOrUpdatePilot($conn,$columns, $values,$positionColumn, $positionValue,$timedateColumn,$timedateValue){
    $updatequery = "INSERT INTO `". getTableName() . "` (" . $columns . ") VALUES (" . $values . ") ON DUPLICATE KEY UPDATE " . $positionColumn ."=CASE WHEN ".$positionColumn." >".$positionValue." THEN ".$positionValue. " ELSE ".$positionColumn." END,"
    .$timedateColumn."=CASE WHEN ".$timedateColumn."<>'$timedateValue' THEN '$timedateValue ' END ";"";
    mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
}
//deleting the data from table older than (10)minutes
function cleanupOldPilots($conn){
    $deletequery="DELETE FROM `". getTableName() . "` WHERE timedate < " . getPilotCleanupTimeout($conn) ."";
    mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
    
}
//printing data from the database into a table ordered by the timedate
function printTable($conn,$printedColumns){
    $sql = "SELECT ".$printedColumns." FROM ".getTableName()." ORDER BY timedate;";
    $result=mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            echo "<table><tr><th> Date </th><th>First name </th><th>Last name </th><th> email </th><th> phone number </th><th> position </th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["timedate"]."</td><td>".$row["Firstname"]."</td><td>".$row["Lastname"]."</td><td> ".$row["email"]."</td><td>".$row["phonenumber"]."</td><td>".$row["position"]."</td></tr>";
            }
            echo "</table>";
    
        } else {
            echo "No drones at the moment";
        }
}
//printing the closest distance and the name of the pilot
function printClosestDistance($conn){
    $query="SELECT MIN(position)AS closest FROM ".getTableName().";";
    $sql="SELECT Firstname, Lastname, position FROM ".getTableName()." ;";
    
    if ($result2=mysqli_query($conn,$sql)AND ($result=mysqli_query($conn,$query))){
        $row = mysqli_fetch_assoc($result);
        $row2=mysqli_fetch_assoc($result2);
        $closest = $row['closest'];
        
        if ($row['position']=$closest){
            $first=$row2['Firstname'];
            $last=$row2['Lastname'];
        echo "<br>The closest distance is : $closest, by $first $last <br>";
        }         
    }
}
//function to get table name
function getTableName(){
    $tablename="drone";
    return "drone";
}
//function to get the timeout when piltos should be deleted from database
function getPilotCleanupTimeout($conn) {
    $timeout="NOW()-INTERVAL 10 MINUTE";
    return $timeout;
    
}
function getDataFromXML(){
    $response=@file_get_contents('http://assignments.reaktor.com/birdnest/drones',true);
     //reading a file into a string 
    if($response ===false){
        echo "Something went wrong with the xml file.";
        die();
    }else{
        $report = new SimpleXMLElement($response); //getting XML data
        return $report;
    }
}
function getDroneTime($report){
    $time=$report->capture['snapshotTimestamp'];
    $a = new \DateTime("$oldtime");
    $time = $a->format('Y-m-d H:i:s');//setting the time variable in the right format
    $time=date('Y-m-d H:i:s');
    return $time;
}
function readAndDecodeJsonFile($SN,$closeatDistanceInsideNDZ){// reading and decoding json string
    $url = "http://assignments.reaktor.com/birdnest/pilots/$SN";
    $json = @file_get_contents($url,true);
    if($json ===false){
        header("refresh: 10"); // The function will refresh the page   
    }else {
        $jsonString=json_decode($json,true);
        return($jsonString);
    }
}
function getDroneData($conn,$drone){
    $SN=$drone->serialNumber;
    $x=$drone->positionX; 
    $y=$drone->positionY; 
    $Squared=((250000-$x)*(250000-$x))+((250000-$y)*(250000-$y));
    $closeatDistanceInsideNDZ=sqrt($Squared); 
    $droneData=[$SN,$closeatDistanceInsideNDZ];    
    return($droneData);
}
function getPilotData($jsonString){
    $firstname=$jsonString["firstName"];
    $lastname=$jsonString["lastName"];
    if (strpos(($lastname),"'") !==false ){
        $lastname=str_replace("'","''",$lastname);//in case there is " ' " in the name ,SQL doesnt consider it as ending tag
    }
    $email=$jsonString["email"];
    if (strpos(($emai),"'") !==false){
        $email=str_replace("'","''",$email);
    }
    $phonenumber=$jsonString["phoneNumber"];
    $pilotData=[$firstname,$lastname,$email,$phonenumber];
    return($pilotData);
}

?>