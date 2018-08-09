<?php

namespace kriss\calendarSchedule;

use yii\web\AssetBundle;

class FullCalendarCustomAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets/1.0';
    public $css = [
        'full-calendar-custom.css'
    ];
    public $js = [
        'full-calendar-custom.js'
    ];
    public $depends = [
        'kriss\calendarSchedule\FullCalendarAsset',
    ];
}
