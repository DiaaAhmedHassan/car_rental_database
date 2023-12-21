create database Car_rental;

use Car_rental;


create table office (
    id int PRIMARY KEY,
    name varchar(225),
    country varchar(225),
    phone_number int
);

create table car (
    plate_id int PRIMARY KEY,
    model varchar(255),
    color varchar(225),
    status varchar(225),
    image varchar(255),
    year int,
    price int,
    mileage int,
    office_id int,
    FOREIGN KEY(office_id) REFERENCES office(id)
);

create table customer (
    id int,
    email varchar(225),
    name varchar(225),
    password varchar(225),
    phone_number int,
    car_id int,
    PRIMARY KEY(id, email),
    FOREIGN KEY(car_id) REFERENCES car(plate_id)
);

create table reservation (
    start_date date,
    end_date date,
    total_price int,
    customer_id int,
    plate_id int,
    PRIMARY KEY(customer_id, plate_id),
    FOREIGN KEY(plate_id) REFERENCES car(plate_id),
    FOREIGN KEY(customer_id) REFERENCES customer(id)
);

create table address (
    id int,
    country varchar(225),
    governorate varchar(225),
    PRIMARY KEY(id, country),
    FOREIGN KEY(id) REFERENCES customer(id)
);

/*
    table creation, primary keys by Mohammed Mohab and Diaa Ahmad
    foreign keys by Youssef Mahmoud
*/