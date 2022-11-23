DROP TABLE IF EXISTS Polls;

CREATE TABLE Polls(
    poll_ID INT NOT NULL AUTO_INCREMENT,
    user_ID INT NOT NULL,
    question VARCHAR(110),
    lastVoteDateTime DATETIME,
    openDateTime DATETIME,
    closeDateTime DATETIME,
    createdDateTime TIMESTAMP,
    PRIMARY KEY (poll_ID),
    FOREIGN KEY (user_ID) REFERENCES Users (user_ID)
);