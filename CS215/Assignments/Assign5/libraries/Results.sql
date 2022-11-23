DROP TABLE IF EXISTS Results;

CREATE TABLE Results(
    result_ID INT NOT NULL AUTO_INCREMENT,
    answer_ID INT NOT NULL,
    resultDateTime DATETIME,
    PRIMARY KEY (result_ID),
    FOREIGN KEY (answer_ID) REFERENCES Answers (answer_ID)
);