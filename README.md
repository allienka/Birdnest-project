# Birdnest-project
not final version yet

The aim of this project is to create a web app to list all the drone pilots, that violated the NDZ perimeter around the nest of endangered bird Monadikuikka.  
The area withing 100 meters of the nest is declared as NDZ.

<b>SPECIFICATIONS:</b><br>
The list should:<br>
- Persist the pilot information for 10 minutes since their drone was last seen by the equipment
- display the closest confirmed distance to the nest
- contain the pilot’s name, email address and phone number
- immediately show the information from the last 10 minutes to anyone opening application
- not re	quire the user to manually refresh the view to see up-to-date information


Drone positions
GET assignments.reaktor.com/birdnest/drones

Pilot information
GET assignments.reaktor.com/birdnest/pilots/:serialNumber


# MAIN FILES:

<b>Connection.php</b><br>
-created a connection to the database

<b>Functions.php</b><br>
-file with functions created to be used in the main index.php file 
Such as inserting and updating data into the database, deleting data and printing out the table

<b>Index.php</b><br>
-set to refresh the web app automatically in 10 minutes
Fetching the data about drones from XML file and setting needed variables such as serial number, X, Y coordinates and time when they were spotted (the snapshot was made). From JSON time we get the data about pilots. 

The no-fly zone is a circle with 100 meters radius, origin at position 250000,250000. With the help of Pythagoras theorem, we can count the distance needed to evaluate eighter the drone crossed the border of NDZ or not.

With the help of functions, we insert or update the data into the database. Data older than 10 minutes will be deleted (delete function) and the printing function shows the list of needed info from the database.

<b>Mystyles.css</b><br>
-styling the web page to responsive table 
