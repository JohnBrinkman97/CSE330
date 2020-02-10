# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

News sharing site by John Brinkman (johnbrinkman 451444) and Blake Dorris (blakedorris 449843)
Link: http://ec2-52-15-51-119.us-east-2.compute.amazonaws.com/~john.brinkman/storyPage.php

### Login Info ###

The website should be able to create a new user and currently works, but if for some reason it does not in the future
a name in the database already is "RandomUser" with password "pass".  

### Creative Portion ###

For the creative portion we made it possible for the user to edit their username or password or delete their account entirely. Initially we thought this 
might be pretty difficult since we'd have to go through and delete all their stories and comments, but it turns out all we had to do was turn on cascade
for updating and deleting so all the linked child items were automatically deleted with the account or the foreign key variables were updated to reference 
the new username. 
We also implemented a timestamp on the stories and comments. The sql database automatically enters the time and date of when the values were input into 
the table using the current timestamp as the default value for the "date" column. 

