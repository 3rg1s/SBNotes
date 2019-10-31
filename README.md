# SBNotes 🗒️
------------
# What is this ℹ️

Secure Notes is a web application, which encrypts your Notes using aes256 and then sends them to the server! This is a school project as a way to learn about web technologies!

# How to set up the database 💽 

✏️ Create a database: `create database project1`  

✏️ Create invite table: `create table invite (id int not null auto_increment unique, used boolean default '0', code varchar(50) not null unique, ownedby varchar(50) default '');` assuming you are inside a sql shell.  

✏️ Create users table: ` create table users(id int auto_increment not null primary key, username varchar(50) not null unique, password varchar(255) not null, created_at datetime default current_timestamp)`  

✏️ Create snotes table: `create table snotes(id int auto_increment not null primary key, note longtext not null, ownedby varchar(50) not null);`  

# Download the repo and make necessary changes to config file 📄  

🏠 Download the repo locally by using the download button or by typing on your terminal `git clone repolink`  
  
  -Add the repo files into /var/www/html *if you are using Linux with apache*(Highly recommended)
  -Add the repo files inside c:\xampp\htdocs\ *if you are using xamp on Windows*(Not recommended)
