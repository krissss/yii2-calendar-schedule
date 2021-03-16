Yii2 FullCalendar Schedule
======================
Yii2 FullCalendar Schedule

Installation
------------

```
composer require kriss/yii2-calendar-schedule
```

Tip
-----

master is in 2.x, want 1.x ? see [1.x branch](https://github.com/krissss/yii2-calendar-schedule/tree/dev-1.x)

Usage
-----

```php
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
```

more see [demos](demos)