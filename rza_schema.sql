-- RZA project - SQL schema
CREATE DATABASE IF NOT EXISTS rza;
USE rza;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(255),
  phone VARCHAR(30),
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  marketing_consent TINYINT(1) DEFAULT 0,
  accessibility_settings JSON NULL
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  booking_type ENUM('zoo_ticket','hotel') NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  status ENUM('pending','confirmed','cancelled','refunded') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  external_reference VARCHAR(255) NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS zoo_tickets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  visit_date DATE NOT NULL,
  ticket_type VARCHAR(50),
  quantity INT,
  price_each DECIMAL(10,2),
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_number VARCHAR(20),
  room_type VARCHAR(50),
  capacity INT,
  description TEXT,
  price_standard DECIMAL(10,2),
  status ENUM('available','out_of_service') DEFAULT 'available'
);

CREATE TABLE IF NOT EXISTS room_inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_id INT,
  date DATE,
  status ENUM('available','booked','blocked') DEFAULT 'available',
  booking_id INT NULL,
  FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE SET NULL,
  UNIQUE (room_id, date)
);

CREATE TABLE IF NOT EXISTS payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT,
  payment_provider VARCHAR(50),
  provider_reference VARCHAR(255),
  amount DECIMAL(10,2),
  status ENUM('authorized','captured','failed','refunded'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS loyalty_accounts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNIQUE,
  points INT DEFAULT 0,
  tier VARCHAR(50),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS educational_resources (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  subject VARCHAR(100),
  age_range VARCHAR(50),
  file_path VARCHAR(512),
  download_count INT DEFAULT 0,
  rating DECIMAL(3,2) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS ticket_capacity (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATE UNIQUE,
  capacity INT DEFAULT 1000,
  booked INT DEFAULT 0
);

-- Sample data
INSERT IGNORE INTO ticket_capacity (date, capacity, booked) VALUES (CURDATE(), 1000, 0);
