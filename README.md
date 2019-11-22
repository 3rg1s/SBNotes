# SBNotes 🗒️
----------------
![Website Status](https://img.shields.io/website?style=for-the-badge&url=https%3A%2F%2F0x0byt3.com)


# How to set up the database 💽 

✏️ Create a database: `create database project1`  

✏️ Create invite table: `create table invite (id int not null auto_increment unique, used boolean default '0', code varchar(50) not null unique, ownedby varchar(50) default '');` assuming you are inside a sql shell.  

✏️ Create users table: ` create table users(id int auto_increment not null primary key, username varchar(50) not null unique, password varchar(255) not null, created_at datetime default current_timestamp);`  

✏️ Create snotes table: `create table snotes(id int auto_increment not null primary key, note longtext not null, ownedby varchar(50) not null);`  


# Download the repo and make necessary changes to config file 📄  

🏠 Download the repo locally by using the download button or by typing on your terminal `git clone https://github.com/3rg1s/SBNotes.git`  
  
  - Add the repo files into /var/www/html *if you are using Linux with apache*(Highly recommended)
  - Add the repo files inside c:\xampp\htdocs\ *if you are using xamp on Windows*(Not recommended)

⌨️ Make the necessary changes inside the **config.php** file.

-----------------

# ⛔ Please Assume there may be a vulnerability in the code, as the web app is not tested yet for such.



👔 TODO:

COMPLETED ✔️
 - ~~add some files inside Folder to not look this messy.~~
 - ~~Make the input tags focused when there is only one left.~~
 - ~~Fix navigator file.~~
 - ~~Add support for smartphones.~~
 - ~~Add better encryption.~~
 - ~~Delete encryption password on user logout~~
 - ~~Add delete option for notes~~
 
IN PROGRESS ▶️
 - Make the signup page look better!
 - Add to the change password the to ask for the current password.
 - Learn some more git.
 - Add a frontpage!
 - Add User settings (Add profile password, auto-delete note)
 - Add a php file to create the database for you! 
