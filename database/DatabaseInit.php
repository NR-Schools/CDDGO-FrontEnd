<?php

require_once("DatabaseConfig.php");

Database::BasicSQL(
    Database::getPDO(), 
    "
    CREATE TABLE IF NOT EXISTS EVENTS (
        EventID INT PRIMARY KEY AUTO_INCREMENT,
        EventImage LONGBLOB NOT NULL,
        EventName VARCHAR(255) NOT NULL,
        EventDescription VARCHAR(255) NOT NULL,
        EventDate DATETIME NOT NULL,
        EventLocation VARCHAR(255) NOT NULL,
        DatePosted DATETIME NOT NULL
    );

    CREATE TABLE IF NOT EXISTS STUDENTS (
        StudID INT PRIMARY KEY AUTO_INCREMENT,
        StudNo VARCHAR(12),
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
        GameDescription VARCHAR(500),
        QuantityAvailable INT,
        GameCategory VARCHAR(255),
        GameStatus VARCHAR(50)
    );

    CREATE TABLE IF NOT EXISTS INQUIRIES(
        InquiryID INT PRIMARY KEY AUTO_INCREMENT,
        InquiryStudID INT NOT NULL,
        InquiryTitle VARCHAR(255) NOT NULL,
        InquiryDesc VARCHAR(255) NOT NULL,
        InquiryCreatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (InquiryStudID) REFERENCES STUDENTS(StudID)
    );
    
    CREATE TABLE IF NOT EXISTS INQUIRY_RESPONSES (
		InquiryResponseID INT PRIMARY KEY AUTO_INCREMENT,
        RefInquiryID INT NOT NULL,
        ResponseText VARCHAR(500) NOT NULL,
        ResponseCreatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        ResponseSource ENUM (\"STUDENT\", \"ADMIN\") NOT NULL,
        FOREIGN KEY (RefInquiryID) REFERENCES INQUIRIES(InquiryID) ON DELETE CASCADE
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
        isPaid BOOLEAN,       -- This means that the reservation is final
        ReservationFee INT,
        FOREIGN KEY (ReservedStudent) REFERENCES STUDENTS(StudID),
        FOREIGN KEY (ReservedGame) REFERENCES BOARD_GAMES(GameID)
    );

    CREATE TABLE IF NOT EXISTS RENTALS (
        RentalID INT PRIMARY KEY AUTO_INCREMENT,
        StudID INT,
        GameID INT,
        BorrowDate DATE, -- as ref for reservation
        Rent INT,
        RentConfirm BOOLEAN,
        FOREIGN KEY (StudID) REFERENCES STUDENTS(StudID),
        FOREIGN KEY (GameID) REFERENCES BOARD_GAMES(GameID)
    );

    CREATE TABLE IF NOT EXISTS NOTIFICATIONS (
        NotificationID INT PRIMARY KEY AUTO_INCREMENT,
        NotificationTitle VARCHAR(50),
        NotificationBody VARCHAR(100),
        TargetEmail VARCHAR(50), 							-- Target Email to Send Notification
        CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    
    "
);

?>