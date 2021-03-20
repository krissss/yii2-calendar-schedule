<?php
/**
 * @var yii\web\View $this
 */
use kriss\calendarSchedule\widgets\FullCalendarWidget;
use kriss\calendarSchedule\widgets\processors\EventProcessor;
use yii\helpers\Url;

$js = <<<JS
function openModal(url) {
    $.get(url, {}, function (data) {
        $(".ajax_modal").remove();
        $('body').append(data);
        $(".ajax_modal").last().modal('show');
    })
}
JS;
$this->registerJs($js);

$renderBefore = <<<JS
calendar.on('eventClick', function (info) {
    console.log(info)
    if (info.event.url) {
        info.jsEvent.preventDefault();
        openModal(info.event.url);
    }
})
JS;

echo FullCalendarWidget::widget([
    'calendarRenderBefore' => $renderBefore,
    'processors' => [
        new EventProcessor([
            'events' => [
                ['title' => 'some title', 'start' => time(), 'end' => time() + 10 * 3600, 'url' => Url::to(['site/event-detail'])], // see FullCalendarEventDetailAction
            ],
        ]),
    ],
]);