
CREATE DATABASE IF NOT EXISTS helpdesk;
USE helpdesk;

CREATE TABLE IF NOT EXISTS users (
    employee_id VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('employee', 'senior', 'admin') NOT NULL,
    senior_id VARCHAR(20), 
    FOREIGN KEY (senior_id) REFERENCES users(employee_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    raised_by VARCHAR(20) NOT NULL,
    senior_id VARCHAR(20),
    status ENUM('unseen', 'working', 'solved', 'rejected') DEFAULT 'unseen',
    admin_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (raised_by) REFERENCES users(employee_id) ON DELETE CASCADE,
    FOREIGN KEY (senior_id) REFERENCES users(employee_id) ON DELETE SET NULL
);
