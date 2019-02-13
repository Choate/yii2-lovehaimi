<?php


namespace choate\yii2\lovehaimi;


use yii\base\Object;

abstract class BaseResponse extends Object
{
    public $code;

    public $desc;

    /**
     * @return bool
     */
    abstract public function getIsSuccess();
}