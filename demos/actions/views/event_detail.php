<?php
/**
 * @var \yii\web\View $this
 */

use yii\bootstrap\Modal;

$modal = Modal::begin([
    'header' => '<h3>detail</h3>',
    'options' => [
        'class' => 'ajax_modal fade'
    ],
    'size' => 'modal-lg',
]);

echo '1111';

$modal->end();