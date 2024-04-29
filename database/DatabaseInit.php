<?php

require_once("DatabaseConfig.php");

Database::BasicSQL(
    Database::getPDO(), 
    "
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
        StudNo VARCHAR(20),
        FirstName VARCHAR(50),
        LastName VARCHAR(50),
        Program VARCHAR(20),
        Email VARCHAR(255),
        Password VARCHAR(20),
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
        GameImage LARGEBLOB,
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
    "
);

?>