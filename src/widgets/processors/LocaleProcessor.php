<?php

namespace kriss\calendarSchedule\widgets\processors;

class LocaleProcessor extends BaseProcessor
{
    /**
     * see @npm/fullcalendar/locales
     * @var string
     */
    public $locale;

    /**
     * @inheritDoc
     */
    public function process()
    {
        if (!$this->locale) {
            return;
        }
        $asset = $this->calendarWidget->fullCalendarAsset;
        $asset::$locale = $this->locale;
        $this->setClientOption('locale', $this->locale);
    }
}