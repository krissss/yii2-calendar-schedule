<?php

namespace kriss\calendarSchedule\events;

use yii\helpers\Url;

class UrlEvent extends BaseEvent
{
    public function __construct($title, $url, $start, $end, $extra = [])
    {
        $fields = array_merge([
            'title' => $title,
            'url' => Url::to($url),
            'start' => $start,
            'end' => $end,
        ], $extra);
        parent::__construct($fields);
    }
}