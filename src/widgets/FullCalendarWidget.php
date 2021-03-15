<?php

namespace kriss\calendarSchedule\widgets;

use kriss\calendarSchedule\assets\FullCalendarAsset;
use kriss\calendarSchedule\widgets\processors\BaseProcessor;
use yii\base\Widget;
use yii\di\Instance;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * 基础框架
 */
class FullCalendarWidget extends Widget
{
    /**
     * FullCalendarAsset::class
     * FullCalendarScheduleAsset::class
     * @var FullCalendarAsset|string
     */
    public $fullCalendarAsset = FullCalendarAsset::class;
    /**
     * @var array
     */
    public $options = [];
    /**
     * @link https://fullcalendar.io/docs
     * @var array
     */
    public $clientOptions = [];
    /**
     * @var BaseProcessor[] array
     */
    public $processors = [];
    /**
     * @var string
     */
    public $clientName = 'myCalendar';
    /**
     * @var string js expression
     */
    public $calendarRenderBefore;
    /**
     * @var string js expression
     */
    public $calendarRenderAfter;

    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        } else {
            $this->setId($this->options['id']);
        }
    }

    public function run()
    {
        foreach ($this->processors as $processor) {
            $processor = Instance::ensure($processor, BaseProcessor::class);
            $processor->calendarWidget = $this;
            $processor->process();
        }

        $asset = $this->fullCalendarAsset;
        $asset::register($this->view);

        if (!isset($this->clientOptions['locale'])) {
            $this->clientOptions['locale'] = $asset::$locale;
        }

        $renderBefore = $this->calendarRenderBefore ? new JsExpression("(function(calendar) {{$this->calendarRenderBefore}})({$this->clientName});\n") : '';
        $renderAfter = $this->calendarRenderAfter ? new JsExpression("\n(function(calendar) {{$this->calendarRenderAfter}})({$this->clientName});") : '';

        $options = Json::encode($this->clientOptions);
        $js = <<<JS
var calendarEl = document.getElementById('{$this->getId()}');
var {$this->clientName} = new FullCalendar.Calendar(calendarEl, {$options});
{$renderBefore}{$this->clientName}.render();{$renderAfter}
JS;
        $this->view->registerJs($js);

        return Html::tag('div', '', $this->options);
    }
}