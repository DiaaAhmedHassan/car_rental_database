/*this code is used once then coment it*/
create database Car_rental;
/*-----------------------------*/
use Car_rental;

/*this code writen by Mohamed Mohab*/
create table office (
    id int PRIMARY KEY,
    name varchar(225),
    country varchar(225),
    phone_number int
);

create table car (
    color varchar(225),
    status varchar(225),
    plate_id int PRIMARY KEY,
    mode varchar(255),
    year int,
    price int,
    mileage int,
    office_id int
);


create table reservation (
    start_date date,
    end_date date,
    total_price int,
    cutomer_id int,
    plate_id int
);

create table customer (
    id int,
    email varchar(225),
    name varchar(225),
    password varchar(225),
    phone_number int,
    car_id int
);
create table address (
    id int,
    country varchar(225),
    governorate varchar(225)
);

ALTER TABLE customer ADD PRIMARY KEY(id,email);
ALTER table address ADD PRIMARY KEY(id, country);
ALTER TABLE reservation ADD PRIMARY KEY(customer_id, plate_id);
ALTER TABLE address ADD PRIMARY KEY(id);
/*------------------------------------------------*/

/*this code writen by Mahmoud reda*/
ALTER TABLE car ADD FOREIGN KEY(office_id) REFERENCES office(office_id);
ALTER TABLE reservation ADD FOREIGN KEY(plate_id) REFERENCES car(plate_id);
ALTER TABLE reservation ADD FOREIGN KEY(customer_id) REFERENCES customer(id);
ALTER TABLE customer ADD FOREIGN KEY(car_id) REFERENCES car(plate_id);
ALTER TABLE address ADD FOREIGN KEY(id) REFERENCES customer(id);
