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
     * FullCalendarAsset::class
     * FullCalendarScheduleAsset::class
     * @var string
     */
    public $fullCalendarAsset = FullCalendarAsset::class;
    /**
     * see @npm/fullcalendar/locales
     * @var string
     */
    public $locale;
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

        $this->registerAssets();
    }

    public function run()
    {
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

    protected function registerAssets()
    {
        /** @var FullCalendarAsset $asset */
        $asset = $this->fullCalendarAsset;

        if ($this->locale) {
            $asset::$locale = $this->locale;
        }
        $asset::register($this->view);

        $this->setClientOption('locale', $asset::$locale);
    }

    public function getClientOption($path, $default = [])
    {
        return ArrayHelper::getValue($this->clientOptions, $path, $default);
    }

    public function setClientOption($path, $value, $merge = true)
    {
        if ($merge) {
            $oldValue = $this->getClientOption($path);
            if ($oldValue) {
                $value = ArrayHelper::merge($oldValue, $value);
            }
        }
        ArrayHelper::setValue($this->clientOptions, $path, $value);
    }
}