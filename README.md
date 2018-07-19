# Iplato Test for Manolache Andrei
## Please read the full documentation before testing

Setup: 
- Add the newIplatoCodingTest folder at the base of your server 
- Edit the /newIplatoCodingTest/Engine/Config.php file with the details of the Database used for this task (the config data is sent to \newIplatoCodingTest\Engine\Db.php)
- Import the MySQL database contained in Iplato.sql 

Basic testing steps :
- go to /newIplatoCodingTest/
- View the list of posts : You shouldn't be able to edit or delete a post
- view a post : The post should display its contents and under it, related comments
- add a comment: Your comment should be validated by the system and if all information is correct, should be sent through ajax and show under the Post at the top of the comment list
- go back to /newIplatoCodingTest/
- login 
- use the following username and password : 
username: test
password: testpassword
- you should be able to add a post
- add a post : the fields in the post are validated and submitted by the form. Due to time constraints only the comments were submitted through ajax
- edit the added post: fields are again validated and should submit correctly
- go back to /newIplatoCodingTest/
- View the list of posts : You should be able to edit or delete a post
- delete the previously created post : the post is deleted, the page refreshed and the post no longer present 


How to improve:
- create a Form tool to generate all the forms and use it 
- use ajax for all forms
- improve the rooting readability as well as not having to type the name of the controller to generate the route
- create a plugin for the JS
- create a responsive listing page allowing organisation by column
- add Categorizing
- clean up css


Due to some time constraints on my part the following issues are present:
- only the Comment form uses ajax to submit 
- no categorizing was added
- CSS from a previous project used so there might be css classes that are never used in the views

This project was done in 2x 2 hour sessions and a 2h30min session totalling a 6h30 total project time
