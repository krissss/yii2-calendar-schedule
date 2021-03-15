<?php

namespace kriss\calendarSchedule\widgets;

use kriss\calendarSchedule\widgets\traits\PresetEvents;
use kriss\calendarSchedule\widgets\traits\PresetLayout;

/**
 * 日历事件查看组件
 */
class CalendarViewWithEventsWidget extends FullCalendarWidget
{
    use PresetLayout;
    use PresetEvents;

    public function run()
    {
        $this->setClientHeaderToolbar();
        $this->setClientEvents();

        return parent::run();
    }
}