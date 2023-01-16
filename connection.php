<?php

function create_dbc(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "drones";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
    


}
function close_db($conn){
    return mysqli_close($conn);
}   