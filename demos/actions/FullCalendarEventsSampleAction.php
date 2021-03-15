<?php

use kriss\calendarSchedule\events\BackgroundEvent;
use kriss\calendarSchedule\events\TitleEvent;
use kriss\calendarSchedule\events\UrlEvent;
use yii\base\Action;
use yii\web\Response;

class FullCalendarEventsSampleAction extends Action
{
    public function run($start, $end)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $month = date('Y-m', strtotime($start));

        return [
            new TitleEvent('100', $month . '-15', $month . '-16'),
            new TitleEvent('100', $month . '-17', $month . '-19'),
            new UrlEvent('url', ['site/events'], $month . '-15', $month . '-16'),
            new BackgroundEvent($month . '-17', $month . '-19', 'red'),
        ];
    }
}
