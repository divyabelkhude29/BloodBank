CREATE DATABASE blood_bank;
USE blood_bank;

-- Admin table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL -- store hashed passwords
);

-- Blood groups
CREATE TABLE blood_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(5) NOT NULL UNIQUE
);

INSERT INTO blood_groups (group_name) VALUES 
('A+'), ('A-'), ('B+'), ('B-'), ('AB+'), ('AB-'), ('O+'), ('O-');

-- Donors
CREATE TABLE donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    blood_group_id INT NOT NULL,
    contact VARCHAR(15),
    address TEXT,
    last_donation_date DATE,
    FOREIGN KEY (blood_group_id) REFERENCES blood_groups(id)
);

-- Blood stock
CREATE TABLE blood_stock (
    blood_group_id INT PRIMARY KEY,
    units INT DEFAULT 0,
    FOREIGN KEY (blood_group_id) REFERENCES blood_groups(id)
);

-- Blood exchange requests
CREATE TABLE blood_exchange (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT NOT NULL,
    blood_group_id INT NOT NULL,
    units INT NOT NULL,
    request_date DATE NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (donor_id) REFERENCES donors(id),
    FOREIGN KEY (blood_group_id) REFERENCES blood_groups(id)
);

-- NGOs
CREATE TABLE ngos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    contact VARCHAR(50),
    address TEXT,
    email VARCHAR(100)
);

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admins (username, password) VALUES ('admin', SHA2('admin123', 256));

INSERT INTO ngos (name, contact, address, email) VALUES
('Helping Hands Foundation', '123-456-7890', '123 Charity St, Cityville', 'contact@helpinghands.org'),
('Life Savers NGO', '987-654-3210', '456 Hope Ave, Townsville', 'info@lifesaversngo.com'),
('Red Cross Volunteers', '555-123-4567', '789 Relief Rd, Metropolis', 'volunteers@redcross.org'),
('Blood Donors United', '222-333-4444', '321 Unity Blvd, Villagetown', 'support@blooddonorsunited.net'),
('Save Lives Initiative', '111-222-3333', '654 Care St, Hamlet', 'contact@savelives.org'),
('Global Aid Network', '444-555-6666', '987 Help Ln, Capital City', 'info@globalaid.net'),
('Hope for All', '777-888-9999', '159 Compassion Rd, Smalltown', 'hopeforall@example.com'),
('Community Care Foundation', '333-444-5555', '753 Kindness Ave, Bigcity', 'contact@communitycare.org');