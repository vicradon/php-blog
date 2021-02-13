-- users table
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (username)
);

-- posts table
CREATE TABLE posts (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content varchar(10000) NOT NULL,
    user_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);

-- comments table
CREATE TABLE comments (
    id int NOT NULL AUTO_INCREMENT,
    content varchar(2000) NOT NULL,
    user_id int,
    post_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id)
    ON DELETE CASCADE
);

