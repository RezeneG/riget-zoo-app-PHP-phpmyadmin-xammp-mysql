
USE rza;
ALTER TABLE users
  ADD COLUMN role VARCHAR(50) DEFAULT 'user' AFTER accessibility_settings,
  ADD COLUMN is_admin TINYINT(1) DEFAULT 0 AFTER role;
