<?php

namespace kriss\calendarSchedule\widgets\processors;

use kriss\calendarSchedule\widgets\FullCalendarWidget;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

abstract class BaseProcessor extends BaseObject
{
    /**
     * @var FullCalendarWidget
     */
    public $calendarWidget;

    /**
     * @return void
     */
    abstract public function process();

    public function getClientOption($path, $default = [])
    {
        return ArrayHelper::getValue($this->calendarWidget->clientOptions, $path, $default);
    }

    public function setClientOption($path, $value, $merge = true)
    {
        if ($merge) {
            $oldValue = $this->getClientOption($path);
            if ($oldValue) {
                $value = ArrayHelper::merge($oldValue, $value);
            }
        }
        ArrayHelper::setValue($this->calendarWidget->clientOptions, $path, $value);
    }
}