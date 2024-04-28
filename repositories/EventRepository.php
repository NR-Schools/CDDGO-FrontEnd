<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/EventModel.php";


class EventRepository
{
    static function addNewEvent(Event $event): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO EVENTS
            VALUES (null, :eventName, :eventDesc, :eventDate, :eventLoc, :datePosted)
            ",
            [
                ":eventName" => $event->EventName,
                ":eventDesc" => $event->EventDescription,
                ":eventDate" => $event->EventDate,
                ":eventLoc" => $event->EventLocation,
                ":datePosted" => $event->DatePosted
            ]
        );
    }

    static function getAllEvents(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM EVENTS
            ",
            []
        );

        $eventList = array();
        foreach ($queryResult as $eventRecord) {
            $event = new Event();
            $event->EventID = $eventRecord['EventID'];
            $event->EventName = $eventRecord['EventName'];
            $event->EventDescription = $eventRecord['EventDescription'];
            $event->EventDate = $eventRecord['EventDate'];
            $event->EventLocation = $eventRecord['EventLocation'];
            $event->DatePosted = $eventRecord['DatePosted'];
            $eventList[] = $event;
        }

        return $eventList;
    }

    static function updateEvent(Event $event): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE EVENTS
            SET
                EventName = :eventName
                AND EventDescription = :eventDesc
                AND EventDate = :eventDate
                AND EventLocation = :eventLoc
                AND DatePosted = :datePosted
            WHERE
                EventID = :eventId
            ",
            [
                ":eventId" => $event->EventID,
                ":eventName" => $event->EventName,
                ":eventDesc" => $event->EventDescription,
                ":eventDate" => $event->EventDate,
                ":eventLoc" => $event->EventLocation,
                ":datePosted" => $event->DatePosted
            ]
        );
    }
}

?>