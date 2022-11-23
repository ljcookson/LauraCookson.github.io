DROP TABLE IF EXISTS Answers;

CREATE TABLE Answers(
    answer_ID INT NOT NULL AUTO_INCREMENT,
    question_ID INT NOT NULL,
    answer VARCHAR(60),
    PRIMARY KEY (answer_ID),
    FOREIGN KEY (question_ID) REFERENCES Questions (question_ID)
);