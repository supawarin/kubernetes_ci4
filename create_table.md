CREATE TABLE users(
    user_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(100) NOT NULL,
    user_email varchar(100) NOT NULL,
    user_password varchar(200) NOT NULL,
    user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)ENGINE=InnoDB DEFAULT CHARSET=utf8;