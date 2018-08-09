<?php

namespace kriss\calendarSchedule;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
    public $sourcePath = '@npm';

    public $css = [
        'fullcalendar/dist/fullcalendar.min.css',
    ];

    public $js = [
        'moment/min/moment.min.js',
        'fullcalendar/dist/fullcalendar.min.js',
        'fullcalendar/dist/locale/zh-cn.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
}
