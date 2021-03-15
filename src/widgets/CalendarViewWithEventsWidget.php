<?php

namespace kriss\calendarSchedule\widgets;

/**
 * 日历事件查看组件
 */
class CalendarViewWithEventsWidget extends FullCalendarWidget
{
    /**
     * ex: [['title' => 'aaa', 'startTime' => '2021-03-14 02:00', 'endTime' => '2021-03-16 06:00']]
     * 支持时间戳
     * @link https://fullcalendar.io/docs/event-parsing
     * @var array
     */
    public $events = [];

    /**
     * @var array
     */
    public $views = ['dayGridMonth', 'timeGridWeek', 'listWeek'];

    /**
     * @var string[]
     */
    public $headerToolbar = [
        'start' => 'prev,next today',
        'center' => 'title',
        'end' => '{views}',
    ];

    protected function makeOptions()
    {
        if ($this->events) {
            if (!isset($this->calendarOptions['events'])) {
                $this->calendarOptions['events'] = [];
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
            $this->calendarOptions['events'] = array_merge($this->calendarOptions['events'], $this->events);
        }

        if (!isset($this->calendarOptions['headerToolbar'])) {
            $this->calendarOptions['headerToolbar'] = [];
        }
        $views = implode(',', $this->views);
        foreach ($this->headerToolbar as $pos => $option) {
            $this->headerToolbar[$pos] = str_replace('{views}', $views, $option);
        }
        $this->calendarOptions['headerToolbar'] = array_merge($this->calendarOptions['headerToolbar'], $this->headerToolbar);

        return parent::makeOptions();
    }
}