# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

John Brinkman 451444 and Blake Dorris 449843 Module 5 Calendar 
http://ec2-52-15-51-119.us-east-2.compute.amazonaws.com/~john.brinkman/calendar.php
### Creative Portion ###
For the creative portion we implemented a tagging system for the calendar. The user has 4 options and the display will color code a tag based on the selected option for each
event. It is also possible to choose if the tags are displayed. We also implemented a way to share events. A user can share an event with another user that will display on the 
other users calendar in a different color signifying that it is a shared event. The user can edit and delete this shared event just like any other event.
In order to edit/delete/share events, we made it so all you have to do to pull up those options is click on each event. Each event is clickable and recognizable by the auto 
incremented id it has in the database so the correct event gets edited/deleted/shared. The current day will be highlighted in green on the calendar. We did this by using a moment object from momentjs.com source.
We copy and pasted the code given on the website to a new file then included that file in our javascript on the calendar page. 

