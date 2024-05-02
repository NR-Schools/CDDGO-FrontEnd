
-- Create Tables
CREATE TABLE IF NOT EXISTS EVENTS (
	EventID INT PRIMARY KEY AUTO_INCREMENT,
    EventName VARCHAR(255),
    EventDescription VARCHAR(255),
    EventDate DATETIME,
    EventLocation VARCHAR(255),
    DatePosted DATETIME
);

CREATE TABLE IF NOT EXISTS STUDENTS (
	StudID INT PRIMARY KEY AUTO_INCREMENT,
    StudNo VARCHAR(10),
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Program VARCHAR(5),
    Email VARCHAR(255),
    Password VARCHAR(8),
    isVerified BOOLEAN
);

CREATE TABLE IF NOT EXISTS MEMBERS (
	MemberID INT PRIMARY KEY,
    Position VARCHAR(50),
    YearJoined INT,
    FOREIGN KEY (MemberId) REFERENCES STUDENTS(StudID)
);

CREATE TABLE IF NOT EXISTS BOARD_GAMES (
	GameID INT PRIMARY KEY AUTO_INCREMENT,
    GameName VARCHAR(50),
    GameDescription VARCHAR(255),
    QuantityAvailable INT,
    GameCategory VARCHAR(255),
    GameStatus VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS INQUIRIES (
	InquiryID INT PRIMARY KEY AUTO_INCREMENT,
    Inquirer INT,
    RepliedInquiry INT,
    InquiryTitle VARCHAR(50),
    InquiryDescription VARCHAR(255),
    isInquirySeen BOOLEAN,
	isFromAdmin BOOLEAN,
    FOREIGN KEY (Inquirer) REFERENCES STUDENTS(StudID),
    FOREIGN KEY (RepliedInquiry) REFERENCES INQUIRIES(InquiryID)
);

CREATE TABLE IF NOT EXISTS TESTIMONIALS (
	StudID INT,
    GameID INT,
    Statement VARCHAR(255),
    Rating INTEGER,
    FOREIGN KEY (StudID) REFERENCES STUDENTS(StudID),
    FOREIGN KEY (GameID) REFERENCES BOARD_GAMES(GameID),
    PRIMARY KEY (StudID, GameID)
);

CREATE TABLE IF NOT EXISTS RESERVATIONS (
	ReservationID INT PRIMARY KEY AUTO_INCREMENT,
    ReservedStudent INT,
    ReservedGame INT,
    ReservedDate DATE,
    isPaid BOOLEAN,
    ReservationFee INT,
    FOREIGN KEY (ReservedStudent) REFERENCES STUDENTS(StudID),
    FOREIGN KEY (ReservedGame) REFERENCES BOARD_GAMES(GameID)
);

CREATE TABLE IF NOT EXISTS RENTALS (
	RentalID INT PRIMARY KEY AUTO_INCREMENT,
    StudID INT,
    GameID INT,
    BorrowDate DATE,
    Rent INT,
    FOREIGN KEY (StudID) REFERENCES STUDENTS(StudID),
    FOREIGN KEY (GameID) REFERENCES BOARD_GAMES(GameID)
);

-- Delete Tables
DROP TABLE IF EXISTS EVENTS;
DROP TABLE IF EXISTS STUDENTS;
DROP TABLE IF EXISTS MEMBERS;
DROP TABLE IF EXISTS BOARD_GAMES;
DROP TABLE IF EXISTS INQUIRIES;
DROP TABLE IF EXISTS TESTIMONIAL;
DROP TABLE IF EXISTS RESERVATION;
DROP TABLE IF EXISTS RENTALS;

-- Queries

-- Auth
-- -- SIGN UP
INSERT INTO STUDENTS VALUES (null, "2021987432", "FName", "LName", "CS", "@email", "Password", FALSE);

-- -- VERIFY
UPDATE STUDENTS SET isVerified = TRUE WHERE StudID = 1;

-- -- LOG IN (Get Email)
SELECT Email FROM STUDENTS WHERE StudID = 1;

-- User Homepage
-- -- Currently Rented Game
SELECT * FROM STUDENTS
	INNER JOIN RENTALS
	ON STUDENTS.StudID = RENTALS.StudID;

-- -- Get Events
SELECT * FROM EVENTS
	ORDER BY EventDate;

-- -- Board Games Name Query
SELECT * FROM BOARD_GAMES WHERE GameName LIKE "%N1G%";

-- -- Get All Events
SELECT * FROM EVENTS;

-- -- Manage Account
UPDATE STUDENTS SET FirstName = "NFN" AND LastName = "NLN" AND Program = "NP" AND Email = "n@email.com" WHERE StudID = 1;

-- -- Inquiries
SELECT * FROM INQUIRIES;
SELECT * FROM INQUIRIES WHERE RepliedInquiry = 1;

-- -- Submit and Reply Inquiry
INSERT INTO INQUIRES VALUES (null, null, "InqTitle", "InqDesc", TRUE);
INSERT INTO INQUIRES VALUES (null, 1, "InqTitle", "InqDesc", TRUE);
INSERT INTO INQUIRES VALUES (null, 2, "InqTitle", "InqDesc", FALSE);

-- -- Get Board Games
SELECT * FROM BOARD_GAMES;

-- -- Get Board Game by Id
SELECT * FROM BOARD_GAMES WHERE GameID = 1;

-- -- Reserve Game
INSERT INTO RESERVATIONS VALUES (null, 1, 1, CURDATE(), TRUE, 500);
-- -- -- Check if has been reserved already by another student
SELECT * FROM RESERVATIONS
	INNER JOIN STUDENTS
		ON RESERVATIONS.StudID = STUDENTS.StudID
	WHERE RESERVATION.GameID = 1;

-- -- Rent Game
INSERT INTO RENTALS VALUES (null, 1, 1, CURDATE(), 50);
-- -- -- Check if has been rented
SELECT * FROM RENTALS
	WHERE RENTALS.GameID = 1;
    
-- -- Add and Edit Board Games
INSERT INTO BOARD_GAMES VALUES (null, "GameName", "GameDesc", 1, "AVAILABLE");
-- UPDATE BOARD_GAMES SET WHERE

-- -- Add and Edit Events








WITH RECURSIVE hierarchy AS (
  SELECT *
  FROM DUMMY_INQ
  WHERE InquiryID = 1 -- Replace 1 with the desired root inquiry ID

  UNION ALL

  SELECT t.*
  FROM DUMMY_INQ t
  INNER JOIN hierarchy h ON t.RepliedInquiry = h.InquiryID
)
SELECT * FROM hierarchy;