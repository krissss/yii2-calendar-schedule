<?php

namespace kriss\calendarSchedule\widgets\processors;

class HeaderToolbarProcessor extends BaseProcessor
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

    /**
     * @inheritDoc
     */
    public function process()
    {
        $views = implode(',', $this->views);
        foreach ($this->headerToolbar as $pos => $option) {
            $this->headerToolbar[$pos] = str_replace('{views}', $views, $option);
        }

        $this->setClientOption('headerToolbar', $this->headerToolbar);
    }
}