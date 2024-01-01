create database Car_rental;

use Car_rental;


create table office (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(225),
    country varchar(225),
    phone_number int
);

create table car (
    plate_id int PRIMARY KEY,
    model varchar(255),
    manufacturer varchar(255),
    color varchar(225),
    status varchar(225) CHECK (status IN ('available', 'rented', 'maintenance')),
    image varchar(255),
    year int,
    price int,
    mileage int,
    office_id int,
    FOREIGN KEY(office_id) REFERENCES office(id)
);

create table customer (
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(225),
    name varchar(225),
    password varchar(225),
    phone_number int
);

create table reservation (
    start_date date,
    end_date date,
    total_price int,
    customer_id int,
    plate_id int,
    time varchar(6),
    PRIMARY KEY(customer_id, plate_id, start_date),
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

DELIMITER $$
CREATE PROCEDURE update_car_status()
        BEGIN
            SET @now:= CURRENT_DATE();

            UPDATE car
            SET car.status = 'available'
            WHERE plate_id IN (
                SELECT plate_id
                FROM reservation
                WHERE end_date <= @now
                OR start_date > @now
            )
            OR plate_id NOT IN (
            	SELECT plate_id
                FROM reservation
            );

            UPDATE car
            SET car.status = 'rented'
            WHERE car.plate_id IN (
                SELECT r.plate_id
                FROM reservation as r
                WHERE r.start_date <= @now
                AND r.end_date > @now
            );
        END $$
DELIMITER ;
SET GLOBAL init_connect = 'CALL update_car_status()';
/*
    table creation, primary keys by Mohammed Mohab and Diaa Ahmad
    foreign keys by Youssef Mahmoud
*/