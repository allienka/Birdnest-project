# Birdnest-project


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

<b>Prerequisites<b><br>

Install XAMPP web server<br>
Any Editor (Preferably VS Code or Sublime Text)<br>
Any web browser with latest version<br>

<b>Languages and Technologies used<b><br>

HTML, CSS
XAMPP (A web server by Apache Friends)
Php
MySQL  

<b>Steps to run the project in your machine<b>

1.Download and install XAMPP in your machine<br>
2.Clone or download the repository<br>
3.Extract all the files and move it to the 'htdocs' folder of your XAMPP directory.<br>
4.Start the Apache and Mysql in your XAMPP control panel.<br>
5.Open your web browser and type 'localhost/phpmyadmin'<br>
6.In phpmyadmin page, create a new database from the left panel and name it as 'drones<br>
7.Open a new tab and type 'localhost/foldername' in the url of your browser    

# MAIN FILES:

<b>Connection.php</b><br>
-created a connection to the database

<b>Functions.php</b><br>
-file with functions created to be used in the main index.php file 
Such as inserting and updating data into the database, deleting data and printing out the table

<b>Index.php</b><br>
-set to refresh the web app automatically in 10 minutes
Fetching the data about drones from XML file and setting needed variables such as serial number, X, Y coordinates and time when they were spotted (the snapshot was made). From JSON file we get the data about pilots. 

The no-fly zone is a circle with 100 meters radius, origin at position 250000,250000. With the help of Pythagoras theorem, we can count the distance needed to evaluate eighter the drone crossed the border of NDZ or not.

With the help of functions, we insert or update the data into the database. Data older than 10 minutes will be deleted (delete function) and the printing function shows the list of needed info from the database.

<b>Mystyles.css</b><br>
-styling the web page to responsive table 

<b>TO DO:</b><br>
-tests<br>
-link to app

# DATABASE STRUCTURE

<img width="425" alt="Screenshot 2023-01-03 at 11 17 34" src="https://user-images.githubusercontent.com/105230372/210329121-268640e6-1882-4bbe-ab98-8d9321f7d064.png">


# Database Drones<br>
<b>Table Drone:</b><br>
-serial number : the drones serial number, primary key<br>
-First name: first name to who the drone is registered<br>
-Last name: last name of the person to who the drone in registered<br>
-email: email of the person<br>
-phone number: person's phone number<br>
-position: the drones position<br>
-timedate: the date and time when the drone was seen in the NDZ


