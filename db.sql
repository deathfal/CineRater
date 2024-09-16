CREATE TABLE users (
    email VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activation_token VARCHAR(255),
    role VARCHAR(50) NOT NULL DEFAULT 'unverified', -- Possible roles: unverified, user, admin
);
