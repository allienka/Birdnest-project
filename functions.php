<?php

//inserting data into the database or update the position and time of the drones that appears again. Position is beeing updated only if the distance is shorter than previous
function sqlInsertUpdate($tble, $cols, $values,$col1, $val1,$col2,$val2){
    require("connection.php");
    $updatequery = "INSERT INTO `". $tble . "` (" . $cols . ") VALUES (" . $values . ") ON DUPLICATE KEY UPDATE " . $col1 ."=CASE WHEN ".$col1." >".$val1." THEN ".$val1. " ELSE ".$col1." END,"
    .$col2."=CASE WHEN ".$col2."<>'$val2' THEN '$val2' END ";"";
    $updateresult = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
  
}
//deleting the data from table older than (10)minutes
function sqlDelete($tble,$minutes){
    require ("connection.php");
   
    $deletequery="DELETE FROM `". $tble . "` WHERE timedate < " . $minutes ."";
    $deleteresult = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
   
}
//printing data from the database into a table ordered by the timedate
function printTable($tble,$cols){
    require("connection.php");
    $sql = "SELECT ".$cols." FROM ".$tble." ORDER BY timedate;";
    
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
        $conn->close();
}
//printing the closest distance from the database
function closestDistance($tble){
    require("connection.php");
    $query="SELECT MIN(position)AS closest FROM ".$tble.";";
  
    $result=mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $closest = $row['closest'];
    

    echo "<br>The closest distance is : $closest. <br>"; 
}

?>