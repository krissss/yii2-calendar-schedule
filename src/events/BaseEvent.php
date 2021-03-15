<?php

namespace kriss\calendarSchedule\events;

use yii\base\Arrayable;

class BaseEvent implements Arrayable
{
    protected $fields = [];

    public function __construct($fields)
    {
        foreach (['start', 'end'] as $key) {
            if (isset($fields[$key]) && is_int($fields[$key]) && strlen((string)$fields[$key]) === 10) {
                // 将秒级时间戳转成毫秒级
                $fields[$key] *= 1000;
            }
        }
        $this->fields = $fields;
    }

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return array_keys($this->fields);
    }

    /**
     * @inheritDoc
     */
    public function extraFields()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return $this->fields;
    }
}