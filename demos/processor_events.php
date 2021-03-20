<?php

use kriss\calendarSchedule\widgets\FullCalendarWidget;
use kriss\calendarSchedule\widgets\processors\EventProcessor;
use kriss\calendarSchedule\widgets\processors\HeaderToolbarProcessor;
use kriss\calendarSchedule\widgets\processors\LocaleProcessor;

echo FullCalendarWidget::widget([
    'calendarRenderBefore' => "console.log('before', calendar)",
    'calendarRenderAfter' => "console.log('after', calendar)",
    'clientOptions' => [
        // all options from fullCalendar
    ],
    'processors' => [
        // quick solve fullCalendar options
        new LocaleProcessor([
            'locale' => 'zh-cn',
        ]),
        new HeaderToolbarProcessor(),
        new EventProcessor([
            // use Array
            /*'events' => [
                ['title' => 'aaa', 'start' => time(), 'end' => time() + 10 * 3600],
            ],*/
            // use Ajax
            'events' => ['site/events'], // see FullCalendarEventsAction
        ]),
    ],
]);