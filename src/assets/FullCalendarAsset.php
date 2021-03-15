<?php

namespace kriss\calendarSchedule\assets;

use yii\web\AssetBundle;

/**
 * wrap for fullcalendar
 * @link http://npmjs.com/package/fullcalendar
 */
class FullCalendarAsset extends AssetBundle
{
    public static $locale = 'zh-cn';

    public $sourcePath = '@npm/fullcalendar';

    public $css = [
        'main.min.css',
    ];

    public $js = [
        'main.min.js',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (static::$locale) {
            if (static::$locale === 'all') {
                $locale = 'locales-all.min.js';
            } else {
                $locale = 'locales/' . static::$locale . '.js';
            }

            $this->js[] = $locale;
        }

        parent::init();
    }
}
