<?php

use yii\web\Response;

class FullCalendarEventDetailAction extends \yii\base\Action
{
    public function run($start, $end)
    {
        Yii::$app->response->format = Response::FORMAT_HTML;

        return $this->controller->render('event_detail'); // views/event_detail.php
    }
}