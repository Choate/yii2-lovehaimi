<?php


namespace choate\yii2\lovehaimi\response;


use choate\yii2\lovehaimi\BaseResponse;

class Contract extends BaseResponse
{
    public function getIsSuccess()
    {
        return strcmp($this->code, 0) === 0;
    }

}