<?php

namespace kriss\calendarSchedule\events;

class TitleEvent extends BaseEvent
{
    public function __construct($title, $start, $end, $extra = [])
    {
        $fields = array_merge([
            'title' => $title,
            'start' => $start,
            'end' => $end,
        ], $extra);

        parent::__construct($fields);
    }
}