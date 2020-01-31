# SBNotes 🗒️

Secure Notes Are hard
----------------
![Website Status](https://img.shields.io/website?style=for-the-badge&url=https%3A%2F%2F0x0byt3.com)


# How to set up the database 💽 

✏️ Create a database: `create database project1;`  

✏️ Create invite table: `create table invite (id int not null auto_increment unique, used boolean default '0', code varchar(50) not null unique, ownedby varchar(50) default '');`  

✏️ Create users table: ` create table users(id int auto_increment not null primary key, username varchar(50) not null unique, password varchar(255) not null, created_at datetime default current_timestamp);`  

✏️ Create snotes table: `create table snotes(id int auto_increment not null primary key, note longtext not null, ownedby varchar(50) not null);`  


# Download the repo and make necessary changes to config file 📄  

🏠 Download the repo locally by using the download button or by typing on your terminal `git clone https://github.com/3rg1s/SBNotes.git`  
  
  - Add the repo files into /var/www/html *if you are using Linux with apache*
  - Add the repo files inside c:\xampp\htdocs\ *if you are using xamp on Windows*

⌨️ Make the necessary changes inside the **config.php** file.

-----------------

## ⛔ There is a chance to be a security issue in this webapp. Please use with caution!



👔 TODO:

COMPLETED ✔️
 - ~~add some files inside Folder to not look this messy.~~
 - ~~Make the input tags focused when there is only one left.~~
 - ~~Add a frontpage!~~
 - ~~Fix navigator file.~~
 - ~~Add support for smartphones.~~
 - ~~Add better encryption.~~
 - ~~Delete encryption password on user logout~~
 - ~~Add delete option for notes~~
 - ~~Fetch all js files locally instead of a cdn.~~
 - ~~CRITICAL :USE PDO  INSTEAD OF mysql_query, TO prevent any type of mysql injection.~~
 - ~~Add User settings (Add profile password, auto-delete note)~~
 - ~~Make the signup page look better!~~
 - ~~To prevent saved password, from other users, perhaps they just close the browser so, the destroypassword.html is never running, when A users login in, destroy any saved local storage. to prevent this type of thing.~~
 - ~~Fix the generate code button on admin page.~~
 - ~~Add to the change password the to ask for the current password.~~
 - ~~Removed the option from user to click to add more particles~~
 
IN PROGRESS ▶️
 - Add a php file to create the database for you!
 - Add roles to users.(admin,normal).
 - Create a admin folder with the admin files there.
 - Add forget password,option which will send a link to reset your password(or something similar).
 - Show user the note does not exist if wrong id is used.
 - Show error message when no note is written on the input box. 
