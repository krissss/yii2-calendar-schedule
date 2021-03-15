<?php

namespace kriss\calendarSchedule\events;

class BackgroundEvent extends BaseEvent
{
    public function __construct($start, $end, $color = null, $extra = [])
    {
        $fields = [
            'display' => 'background',
            'start' => $start,
            'end' => $end,
        ];
        if ($color) {
            $fields['color'] = $color;
        }
        $fields = array_merge($fields, $extra);

        parent::__construct($fields);
    }
}