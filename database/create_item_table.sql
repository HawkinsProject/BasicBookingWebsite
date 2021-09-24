CREATE TABLE IF NOT EXISTS car (    
    id integer not null primary key autoincrement,    
    model varchar(80) not null,
    colour varchar(10),    
    year int,
    rego varchar(6) not null,
    odometer value); 

CREATE TABLE IF NOT EXISTS client (    
    id integer not null primary key autoincrement,    
    fullName varchar(20) not null,
    age int,
    dob datetime,
    licenseNO integer not null,
    licenseType varchar(10) not null); 

CREATE TABLE IF NOT EXISTS bookings (    
    id integer not null primary key autoincrement,
	vehicleId INTEGER NOT NULL REFERENCES car(id),
	custId INTEGER NOT NULL REFERENCES client(id),
    startDate datetime,
    endDate datetime); 

insert into car values (null, "Toyota Echo", "White",  2004, "123ABC", 91202);
insert into car values (null, "Impala Chevrolet", "Black", 1967, "KAZ2Y5", 305111);
insert into car values (null, "Ford Anglia 105E", "Sky Blue",  1960, "7990TD", 229823);
insert into car values (null, "Volkswagen Beetle", 1962, "White", "OFP857", 34233);
insert into car values (null, "Pontiac Trans Am", "Black", 1982, "KNIGHT", 21879);

insert into client values (null, "Hayao Miyazaki",  58, '05/01/1941', 099878234, "Open");
insert into client values (null, "Trevor Belmont", 28, '03/04/1994', 459080393, "HR");
insert into client values (null, "Luna Lovegood",  40, '13/02/1981', 872654873, "MR");

insert into bookings values(null, 1, 1, '2021-09-01', '2021-09-02');
insert into bookings values(null, 2, 2, '2021-09-01', '2021-09-03');
insert into bookings values(null, 3, 3, '2021-09-01', '2021-09-05');
insert into bookings values(null, 5, 1, '2021-09-01', '2021-09-02');
insert into bookings values(null, 5, 1, '2021-09-10', '2021-09-16');