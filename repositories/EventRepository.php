<?php

require_once ("database/DatabaseConfig.php");
require_once ("models/EventModel.php");


class EventRepository
{
    function addNewEvent(Event $event): bool
    {
        global $PDOConnection;

        return SQLwithoutFetch(
            $PDOConnection,
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

    function getAllEvents(): array
    {
        global $PDOConnection;

        $queryResult = SQLwithFetch(
            $PDOConnection,
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

    function updateEvent(Event $event): bool
    {
        global $PDOConnection;

        return SQLwithoutFetch(
            $PDOConnection,
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