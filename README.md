# Birdnest-project
not final version yet

The aim of this project is to create a web app to list all the drone pilots, that violated the NDZ perimeter around the nest of endangered bird Monadikuikka.  
The area withing 100 meters of the nest is declared as NDZ.

SPECIFICATIONS:
The list should:
- Persist the pilot information for 10 minutes since their drone was last seen by the equipment
- display the closest confirmed distance to the nest
- contain the pilot’s name, email address and phone number
- immediately show the information from the last 10 minutes to anyone opening application
- not re	quire the user to manually refresh the view to see up-to-date information


Drone positions
GET assignments.reaktor.com/birdnest/drones

Pilot information
GET assignments.reaktor.com/birdnest/pilots/:serialNumber


