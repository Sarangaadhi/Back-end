DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `driver`;
DROP TABLE IF EXISTS `conductor`;
DROP TABLE IF EXISTS `employee`;
DROP TABLE IF EXISTS `trip_expenses`;
DROP TABLE IF EXISTS `trip`;
DROP TABLE IF EXISTS `route`;
DROP TABLE IF EXISTS `route_type`;
DROP TABLE IF EXISTS `vehicle`;


CREATE TABLE `employee` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nic_number` varchar(16) NOT NULL UNIQUE,
    `first_name` varchar(24) NOT NULL,
    `last_name` varchar(24) NOT NULL,
    `address_line_1` varchar(32) NULL,
    `address_line_2` varchar(32) NULL,
    `city` varchar(24) NOT NULL,
    `telephone` varchar(16) NULL,
    `email` varchar(64) NOT NULL,
    `designation` varchar(24) NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `employee_id` int(11) NOT NULL,
    `username` varchar(64) NOT NULL UNIQUE,
    `password` varchar(64) NOT NULL,
    `is_manager` tinyint(1) NOT NULL DEFAULT 0,
    `is_admin` tinyint(1) NOT NULL DEFAULT 0,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `driver` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `employee_id` int(11) NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `conductor` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `employee_id` int(11) NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `vehicle` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `make` varchar(24) NOT NULL,
    `model` varchar(24) NOT NULL,
    `manufactured_year` int(4) NOT NULL,
    `number_of_seats` int(3) NOT NULL,
    `registration_number` varchar(10) NOT NULL UNIQUE,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `route_type` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `route_type_name` varchar(24) NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `route` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `route_type_id` int(11) NOT NULL,
    `route_number` varchar(12) NOT NULL UNIQUE,
    `route_name` varchar(24) NOT NULL UNIQUE,
    `route_description` varchar(64) NOT NULL,
    `route_length` int(6) NOT NULL, /* in meters */
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (route_type_id) REFERENCES route_type(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trip` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `vehicle_id` int(11) NOT NULL,
    `route_id` int(11) NOT NULL,
    `trip_number` int(6) NOT NULL UNIQUE,
    `fuel_consumed` int(16) NOT NULL, /* in milileters */
    `distance_traveled` int(16) NOT NULL, /* in meters */
    `cash_collected` int(16) NOT NULL, /* in cents */
    `is_final` tinyint(1) NOT NULL DEFAULT 0, /* finalization */
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (route_id) REFERENCES route(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trip_expenses` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `trip_id` int(11) NOT NULL,
    `description` varchar(24) NOT NULL,
    `amount` int(16) NOT NULL, /* in cents */
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (trip_id) REFERENCES trip(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;