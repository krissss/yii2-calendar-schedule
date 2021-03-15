<?php

namespace kriss\calendarSchedule\widgets\processors;

use yii\helpers\Url;

class EventProcessor extends BaseProcessor
{
    /**
     * events array: [['title' => 'aaa', 'startTime' => '2021-03-14 02:00', 'endTime' => '2021-03-16 06:00']] // 支持时间戳
     * url array: ['event/json']
     * url string: 'event/json'
     * @link https://fullcalendar.io/docs/event-model
     * @link https://fullcalendar.io/docs/event-source
     * @var array|string
     */
    public $events = [];

    /**
     * @inheritDoc
     */
    public function process()
    {
        if (!$this->events) {
            return;
        }

        if (is_array($this->events) && isset($this->events[0]) && !is_array($this->events[0])) {
            $this->events = Url::to($this->events);
        }

        $this->setClientOption('events', $this->events);
    }
}