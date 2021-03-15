<?php

namespace kriss\calendarSchedule\widgets\traits;

trait PresetEvents
{
    /**
     * ex: [['title' => 'aaa', 'startTime' => '2021-03-14 02:00', 'endTime' => '2021-03-16 06:00']]
     * 支持时间戳
     * @link https://fullcalendar.io/docs/event-parsing
     * @var array
     */
    public $events = [];

    public function setClientEvents()
    {
        if (!$this->events) {
            return;
        }

        $this->events = array_map(function ($event) {
            foreach (['start', 'end'] as $key) {
                if (isset($event[$key]) && is_int($event[$key]) && strlen((string)$event[$key]) === 10) {
                    // 将秒级时间戳转成毫秒级
                    $event[$key] *= 1000;
                }
            }
            return $event;
        }, $this->events);

        $this->setClientOption('events', $this->events);
    }
}