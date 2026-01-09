CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE artworks
ADD status ENUM('pending', 'approved') DEFAULT 'pending';


INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@example.com', '$2y$10$ZqvYp2V6F5pItA9oUKKq..Uw0gkBclTK1kVZ3A0mCAzM9htlqf7K2', 'admin');
