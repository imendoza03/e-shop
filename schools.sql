create database if not exists numericall DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
use numericall;

create table schools(
	id int unsigned auto_increment primary key not null,
    `name` varchar(255) not null
) engine INNODB charset utf8 collate utf8_bin;

create table students(
	id int unsigned auto_increment primary key not null,
    firstname varchar(255) not null,
    lastname varchar(255) not null,
    school_id int unsigned not null,
    foreign key (school_id) references schools(id)
) engine innodb charset utf8 collate utf8_bin;

create table staff(
	id int unsigned auto_increment primary key not null,
    firstname varchar(255) not null,
    lastname varchar(255) not null,
    school_id int unsigned not null,
    foreign key (school_id) references schools(id)
) engine innodb charset utf8 collate utf8_bin;

create table staff_schools(
	staff_id int unsigned not null,
    school_id int unsigned not null,
    foreign key (staff_id) references staff(id),
    foreign key (school_id) references schools(id)
) engine innodb charset utf8 collate utf8_bin;

insert into schools(`name`) values('luxembourg');
insert into schools(`name`) values('piennes');
insert into students(firstname, lastname, school_id) values('Daniela', 'Fernades', 1);
insert into students(firstname, lastname, school_id) values('Ivan', 'Mendoza', 1);
insert into students(firstname, lastname, school_id) values('Arthur', 'Clement', 1);
insert into staff(id, firstname, lastname, school_id) values('Matthieu', 'Vallance', 1);
insert into staff(id, firstname, lastname, school_id) values('Igor', 'Marty', 1);
insert into staff(id, firstname, lastname, school_id) values('Jerome', 'Poslednik', 2);
insert into staff_schools(staff_id, school_id) values('1', '1');
insert into staff_schools(staff_id, school_id) values('2', '1');
insert into staff_schools(staff_id, school_id) values('3', '2');

select * from students 
join staff_schools on schools.id = staff_schools.school_id
where staff.id = 1;