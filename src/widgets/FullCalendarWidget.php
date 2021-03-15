<?php

namespace kriss\calendarSchedule\widgets;

use kriss\calendarSchedule\assets\FullCalendarAsset;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * 基础框架
 */
class FullCalendarWidget extends Widget
{
    /**
     * see @npm/fullcalendar/locales
     * @var string
     */
    public $locale;

    /**
     * @link https://fullcalendar.io/docs
     * @var array
     */
    public $calendarOptions = [];

    public $clientName = 'myCalendar';

    public $calendarRenderBefore;

    public $calendarRenderAfter;

    public function init()
    {
        parent::init();

        $this->registerAssets();
    }

    public function run()
    {
        $options = $this->makeOptions();

        $renderBefore = new JsExpression($this->calendarRenderBefore ?? '');
        $renderAfter = new JsExpression($this->calendarRenderAfter ?? '');

        $js = <<<JS
var calendarEl = document.getElementById('{$this->getId()}');
var {$this->clientName} = new FullCalendar.Calendar(calendarEl, {$options});
(function (calendar) {
    {$renderBefore}
})({$this->clientName});
{$this->clientName}.render();
(function (calendar) {
    {$renderAfter}
})({$this->clientName});
JS;
        $this->view->registerJs($js);

        return Html::tag('div', '', ['id' => $this->getId()]);
    }

    protected function registerAssets()
    {
        if ($this->locale) {
            FullCalendarAsset::$locale = $this->locale;
        }
        FullCalendarAsset::register($this->view);
    }

    protected function makeOptions()
    {
        return Json::encode(ArrayHelper::merge([
            'locale' => FullCalendarAsset::$locale,
        ], $this->calendarOptions));
    }
}