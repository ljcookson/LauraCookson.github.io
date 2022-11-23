DROP TABLE IF EXISTS Questions;

CREATE TABLE Questions(
    question_ID INT NOT NULL AUTO_INCREMENT,
    poll_ID INT NOT NULL,
    question VARCHAR(110),
    PRIMARY KEY (question_ID),
    FOREIGN KEY (poll_ID) REFERENCES Polls (poll_ID)
);