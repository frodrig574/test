create database  IF NOT EXISTS test03;
use test03;
create table IF NOT EXISTS users(id int(11) not null auto_increment primary key, name varchar(80) not null, email varchar(100) not null,phone varchar(20) not null, date_nat date not null);
create table IF NOT EXISTS role(id int(11) not null primary key auto_increment, role varchar(60) not null);
create table IF NOT EXISTS role_user(id int(11) not null primary key auto_increment, id_users int(11) not null, id_role int(11) not null, foreign key(id_users) references users(id),foreign key(id_role) references role(id) );
create user test03 identified by "1234";
grant ALL PRIVILEGES ON test03.* to "test03";	
create table if not exists session(id int(11) not null primary key auto_increment, user varchar(100) not null, pass varchar(100)not null,question_secret varchar(100) not null,response_secret varchar(100) not null);
	insert into session(id,user,pass,question_secret,response_secret)values("1","test@gmail.com","e10adc3949ba59abbe56e057f20f883e","who are you","test");