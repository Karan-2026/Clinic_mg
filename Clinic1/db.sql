-- Create Database
CREATE DATABASE IF NOT EXISTS clinic_mgm;
USE clinic_mgm;

-- Create Doctors Table
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Receptionists Table
CREATE TABLE receptionists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Sample Data into Doctors Table
INSERT INTO doctors (name, email, password) 
VALUES 
('Dr. John Doe', 'john.doe@example.com', '$2y$10$eBwJ5JDJgQH8oPd0kHcXku9gJDPb3sU5Wdh1ux6AA2i4Plux5KPDi'); -- password: doctor123

-- Insert Sample Data into Receptionists Table
INSERT INTO receptionists (name, email, password) 
VALUES 
('Jane Smith', 'jane.smith@example.com', '$2y$10$eBwJ5JDJgQH8oPd0kHcXku9gJDPb3sU5Wdh1ux6AA2i4Plux5KPDi'); -- password: receptionist123

-- Create Appointments Table (Optional Future Use)
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    receptionist_id INT,
    patient_name VARCHAR(100) NOT NULL,
    appointment_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    FOREIGN KEY (receptionist_id) REFERENCES receptionists(id)
);

-- Create Patients Table (Optional Future Use)
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
