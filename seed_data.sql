
USE rza;
INSERT INTO users (email, password_hash, full_name, phone, marketing_consent) VALUES
('demo@example.com', 'REPLACE_WITH_HASH', 'Demo User', '+441234567890', 1);
INSERT INTO rooms (room_number, room_type, capacity, description, price_standard, status) VALUES
('101', 'Standard Double', 2, 'Ground floor room with garden view', 75.00, 'available'),
('102', 'Family Suite', 4, 'Two bedrooms, ideal for families', 120.00, 'available');
-- Pre-populate room_inventory for next 30 days as available
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-03', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-03', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-04', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-04', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-05', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-05', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-06', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-06', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-07', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-07', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-08', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-08', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-09', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-09', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-10', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-10', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-11', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-11', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-12', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-12', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-13', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-13', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-14', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-14', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-15', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-15', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (1, '2025-10-16', 'available');
INSERT IGNORE INTO room_inventory (room_id, date, status) VALUES (2, '2025-10-16', 'available');
