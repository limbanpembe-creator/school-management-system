CREATE TABLE buses (
    id SERIAL PRIMARY KEY,
    bus_number VARCHAR(20) NOT NULL,
    capacity INT NOT NULL,
    driver_name VARCHAR(100) NOT NULL,
    license_plate VARCHAR(20) NOT NULL,
    route VARCHAR(100) NOT NULL
);

CREATE TABLE bus_schedules (
    id SERIAL PRIMARY KEY,
    bus_id INT REFERENCES buses(id),
    departure_time TIME NOT NULL,
    arrival_time TIME NOT NULL,
    weekday VARCHAR(20) NOT NULL
);
