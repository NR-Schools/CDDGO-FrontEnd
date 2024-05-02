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
            VALUES (null, :eventImage, :eventName, :eventDesc, :eventDate, :eventLoc, :datePosted)
            ",
            [
                ":eventImage" => $event->EventImage,
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
            $event->EventImage = $eventRecord['EventImage'];
            $event->EventName = $eventRecord['EventName'];
            $event->EventDescription = $eventRecord['EventDescription'];
            $event->EventDate = $eventRecord['EventDate'];
            $event->EventLocation = $eventRecord['EventLocation'];
            $event->DatePosted = $eventRecord['DatePosted'];
            $eventList[] = $event;
        }

        return $eventList;
    }

    static function getEventById(int $eventId): Event
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM EVENTS WHERE EventID = :eventId
            ",
            [":eventId" => $eventId]
        );

        $event = new Event();
        foreach ($queryResult as $eventRecord) {
            $event->EventID = $eventRecord['EventID'];
            $event->EventImage = $eventRecord['EventImage'];
            $event->EventName = $eventRecord['EventName'];
            $event->EventDescription = $eventRecord['EventDescription'];
            $event->EventDate = $eventRecord['EventDate'];
            $event->EventLocation = $eventRecord['EventLocation'];
            $event->DatePosted = $eventRecord['DatePosted'];
            break;
        }

        return $event;
    }

    static function updateEvent(Event $event): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE EVENTS
            SET
                EventImage = :eventImage,
                EventName = :eventName,
                EventDescription = :eventDesc,
                EventDate = :eventDate,
                EventLocation = :eventLoc,
                DatePosted = :datePosted
            WHERE
                EventID = :eventId
            ",
            [
                ":eventId" => $event->EventID,
                ":eventImage" => $event->EventImage,
                ":eventName" => $event->EventName,
                ":eventDesc" => $event->EventDescription,
                ":eventDate" => $event->EventDate,
                ":eventLoc" => $event->EventLocation,
                ":datePosted" => $event->DatePosted
            ]
        );
    }

    static function deleteEvent(int $eventId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM EVENTS WHERE EventID = :eventId
            ",
            [ ":eventId" => $eventId ]
        );
    }
}

?>