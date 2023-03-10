# Birdnest-project

The aim of this project is to create a web app to list all the drone pilots that violated the NDZ perimeter around the nest of the endangered bird Monadikuikka. The area within 100 meters of the nest is declared as NDZ.

# SPECIFICATIONS: 
<b>The list should:</b>:

- Persist the pilot information for 10 minutes since their drone was last seen by the equipment
- display the closest confirmed distance to the nest
- contain the pilot’s name, email address and phone number
- immediately show the information from the last 10 minutes to anyone opening application
- not require the user to manually refresh the view to see up-to-date information

<b>Drone positions</b>

GET assignments.reaktor.com/birdnest/drones

<b>Pilot information</b>

GET assignments.reaktor.com/birdnest/pilots/:serialNumber

# PREREQUISITES

- Install XAMPP web server
- Any Editor (Preferably VS Code or Sublime Text)
- Any web browser with the latest version


Languages and Technologies used

- HTML, CSS
- XAMPP (A web server by Apache Friends)
- Php 
- MySQL


<b>Steps to run the project on your machine</b>

1. Download and install XAMPP on your machine 
2. Clone or download the repository 
3. Extract all the files and move it to the 'htdocs' folder of your XAMPP directory. 
4. Start Apache and Mysql in your XAMPP control panel. 
5. Open your web browser and type 'localhost/phpmyadmin' 
6. In phpmyadmin page, create a new database from the left panel and name it as drones 
7. Import drone table (drones.sql)
8. Open them in editor and run index.php
9. In web browser open localhost/nameofthexamppfolder


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


<b>the web app look:</b><br>
<img width="1898" alt="Screenshot 2023-01-12 at 16 12 15" src="https://user-images.githubusercontent.com/105230372/212089185-a3e87edd-2a47-4df9-a807-bfbcce034b6a.png">


# Link to the app 
https://solee.com/birdnest-project/

