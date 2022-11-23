DROP TABLE IF EXISTS Users;

CREATE TABLE Users(
    user_ID INT NOT NULL AUTO_INCREMENT,
    first_Name VARCHAR(25),
    last_Name VARCHAR(25),
    userName VARCHAR(15),
    pword VARCHAR(10),
    email VARCHAR(50),
    avatar VARCHAR(255),
    PRIMARY KEY (user_ID)
);