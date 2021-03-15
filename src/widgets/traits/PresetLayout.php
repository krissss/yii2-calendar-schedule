<?php

namespace kriss\calendarSchedule\widgets\traits;

trait PresetLayout
{
    /**
     * @var string[]
     */
    public $headerToolbar = [
        'start' => 'prev,next today',
        'center' => 'title',
        'end' => '{views}',
    ];

    /**
     * @var array
     */
    public $views = ['dayGridMonth', 'timeGridWeek', 'listWeek'];

    protected function setClientHeaderToolbar()
    {
        $views = implode(',', $this->views);
        foreach ($this->headerToolbar as $pos => $option) {
            $this->headerToolbar[$pos] = str_replace('{views}', $views, $option);
        }

        $this->setClientOption('headerToolbar', $this->headerToolbar);
    }
}