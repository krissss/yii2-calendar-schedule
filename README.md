Yii2 Calendar Schedule
======================
Yii2 Calendar Schedule

ScreenShot
------------
![Effect picture 1](https://github.com/krissss/yii2-calendar-schedule/blob/master/src/screenshot.png "Effect picture 1")  

Installation
------------

```
php composer.phar require --prefer-dist kriss/yii2-calendar-schedule -vvv
```

Usage
-----

```php
<?php

use kriss\calendarSchedule\CalendarScheduleWidget;
use yii\web\JsExpression;

$jsRemoveCallback = <<<JS
function(title) {
  console.log('removeCallback', title);
}
JS;

$jsCreateCallback = <<<JS
function(title, color) {
  console.log('createCallback', title, color);
}
JS;

echo CalendarScheduleWidget::widget([
    'draggableEvents' => [
        'items' => [
            ['name' => '洗冰箱', 'color' => '#286090'],
            ['name' => '擦玻璃', 'color' => '#f0ad4e'],
        ],
        'removeCallback' => new JsExpression($jsRemoveCallback)
    ],
    'createEvents' => [
        'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        'createCallback' => new JsExpression($jsCreateCallback)
    ],
    'fullCalendarOptions' => [
        'events' => [
            ['title' => '测试', 'start' => date('Y-m-d 10:00:00'), 'end' => date('Y-m-d 20:00:00'), 'color' => '#286090'],
            ['title' => '测试', 'start' => date('Y-m-10 10:00:00'), 'allDay' => true, 'color' => '#5bc0de'],
        ],
        'eventReceive' => new JsExpression("function(event) { console.log('eventReceive', event) }"),
        'eventDrop' => new JsExpression('function(event) {console.log("eventDrop", event)}'),
        'eventResize' => new JsExpression('function(event) {console.log("eventResize", event)}'),
        'eventClick' => new JsExpression('function(event) {console.log("eventClick", event)}'),
    ]
]);
```
