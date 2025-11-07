-- 1) Tạo DB và chọn DB (đổi tên nếu bạn muốn)
CREATE DATABASE IF NOT EXISTS demo_login
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE demo_login;

-- 2) Xoá bảng cũ nếu có (tránh xung đột cấu trúc)
DROP TABLE IF EXISTS `users`;

-- 3) Tạo bảng users
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  -- Đổi tên cột để tránh nhầm với hàm PASSWORD()
  `password_hash` CHAR(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4) Thêm tài khoản mặc định
INSERT INTO `users` (`username`, `password_hash`)
VALUES ('admin', MD5('123456'));
-- Tài khoản mặc định: admin / 123456
