<?php


//inserting data into the database or update the position and time of the drones that appears again. Position is beeing updated only if the distance is shorter than previous
function insertOrUpdatePilot($conn,$columns, $values,$positionColumn, $positionValue,$timedateColumn,$timedateValue){
    
    $updatequery = "INSERT INTO `". getDroneTableName($conn) . "` (" . $columns . ") VALUES (" . $values . ") ON DUPLICATE KEY UPDATE " . $positionColumn ."=CASE WHEN ".$positionColumn." >".$positionValue." THEN ".$positionValue. " ELSE ".$positionColumn." END,"
    .$timedateColumn."=CASE WHEN ".$timedateColumn."<>'$timedateValue' THEN '$timedateValue' END ";"";
    $updateresult = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
    
}

//deleting the data from table older than (10)minutes
function cleanupOldPilots($conn){
    
    $deletequery="DELETE FROM `". getDroneTableName($conn) . "` WHERE timedate < " . getPilotCleanupTimeout($conn) ."";
    $deleteresult = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
    
}
//printing data from the database into a table ordered by the timedate
function printTable($conn,$printedColumns){
   
    $sql = "SELECT ".$printedColumns." FROM ".getDroneTableName($conn)." ORDER BY timedate;";
    
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
function getClosestDistance($conn){
   
    $query="SELECT MIN(position)AS closest FROM ".getDroneTableName($conn).";";
    
    $sql="SELECT Firstname, Lastname, position FROM ".getDroneTableName($conn)." ;";
    
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
function getDroneTableName($conn){
   
    $query = "SHOW tables;";
    $result = $conn->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $tablename= $rows[0]["Tables_in_drones"];
    return $tablename;
     
}
//function to get the timeout when piltos should be deleted from database
function getPilotCleanupTimeout($conn) {
    
    $timeout="NOW()-INTERVAL 10 MINUTE";
    return $timeout;
    
}
function getDataFromXML(){
    $response=file_get_contents('http://assignments.reaktor.com/birdnest/drones'); //reading a file into a string 
    $report = new SimpleXMLElement($response); //getting XML data
    return $report;
    
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
    /*$json = file_get_contents($url);
    $jsonString=json_decode($json,true);
    return($jsonString);*/
    $json = @file_get_contents($url,true);
    if($json ===false){
        echo "Something went wrong. Page will be refreshed in 2 minutes.";
    }else {
        $jsonString=json_decode($json,true);
        return($jsonString);
    }

}
function getPilotData($jsonString){
    $firstname=$jsonString["firstName"];
    $lastname=$jsonString["lastName"];
    if (strpos(($lastname),"'") !==false ){
        $lastname=str_replace("'","''",$lastname);
    }
    $email=$jsonString["email"];
    if (strpos(($emai),"'") !==false){
        $email=str_replace("'","''",$email);
    }
    $phonenumber=$jsonString["phoneNumber"];
    $pilotData=[$firstname,$lastname,$email,$phonenumber];
    return($pilotData);
     
}

function getDroneData($drone){
    $SN=$drone->serialNumber;
    $x=$drone->positionX; 
    $y=$drone->positionY; 
    $Squared=((250000-$x)*(250000-$x))+((250000-$y)*(250000-$y));
    $closeatDistanceInsideNDZ=sqrt($Squared); 
    $droneData=[$SN,$closeatDistanceInsideNDZ];    
    return($droneData);
}

?>