create table email_users (name varchar(255) not null, username varchar(255) primary key, password 

create table email_emails(id int not null auto_increment primary key, fromuser varchar(255) not null, touser text  not null, time timestamp not null, subject text, body longtext, status enum('y','n') not null default 'y');


