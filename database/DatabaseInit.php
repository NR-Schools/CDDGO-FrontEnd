<?php

require_once("DatabaseConfig.php");

Database::BasicSQL(
    Database::getPDO(), 
    "
    CREATE TABLE IF NOT EXISTS EVENTS (
        EventID INT PRIMARY KEY AUTO_INCREMENT,
        EventImage LONGBLOB,
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
        GameImage LONGBLOB,
        GameDescription VARCHAR(255),
        QuantityAvailable INT,
        GameCategory VARCHAR(255),
        GameStatus VARCHAR(50)
    );

    CREATE TABLE IF NOT EXISTS INQUIRIES(
        InquiryID INT NOT NULL AUTO_INCREMENT,
        InquiryStudID INT NOT NULL,
        InquiryTitle VARCHAR(255) NOT NULL,
        InquiryDesc TEXT NOT NULL,
        InquiryTime DATETIME NOT NULL,
        isInquirySeen BOOLEAN,
        InquiryReply TEXT NULL,
        PRIMARY KEY (InquiryID),
        FOREIGN KEY (InquiryStudID) REFERENCES STUDENTS(StudID)
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