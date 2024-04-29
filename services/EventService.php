<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/EventRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/EventModel.php";

class EventService
{
    static function addEvent(Event $event): bool
    {
        return EventRepository::addNewEvent($event);
    }

    static function getAllEvents(): array
    {
        return EventRepository::getAllEvents();
    }

    static function getEventById(int $eventId): Event
    {
        return EventRepository::getEventById($eventId);
    }

    static function updateEvent(Event $event): bool
    {
        return EventRepository::updateEvent($event);
    }
}

?>