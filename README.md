# SBNotes 🗒️

Secure Notes Are hard
----------------
![Website Status](https://img.shields.io/website?style=for-the-badge&url=https://sbn.0x0byt3.com)


# How to set up the database 💽 

✏️ Create a database: `create database project1;`  

✏️ Set the current working database: `use project1;`   

✏️ Create invite table: `create table invite (id int not null auto_increment unique, used boolean default '0', code varchar(50) not null unique, ownedby varchar(50) default '');`   

✏️ Create users table: ` create table users(id int auto_increment not null primary key, username varchar(50) not null unique, password varchar(255) not null, created_at datetime default current_timestamp);`   

✏️ Create snotes table: `create table snotes(id int auto_increment not null primary key, note longtext not null, ownedby varchar(50) not null);`   

✏️ Create a invite code to use ti in order to create a admin account.:`INSERT INTO invite(code) VALUES (UUID());`

✏️ Copy the code : `select code from invite;`

# Download the repo and make necessary changes to config file 📄  

🏠 Download the repo locally by using the download button or by typing on your terminal `git clone https://github.com/3rg1s/SBNotes.git`  
  
  - Add the repo files into /var/www/html *if you are using Linux with apache*
  - Add the repo files inside c:\xampp\htdocs\ *if you are using xamp on Windows*

⌨️ Make the necessary changes inside the **config.php** file.

-----------------

## ⛔ There is a chance to be a security issue in this webapp. Please use with caution!
