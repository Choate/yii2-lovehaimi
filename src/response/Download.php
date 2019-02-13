<?php


namespace choate\yii2\lovehaimi\response;


use choate\yii2\lovehaimi\BaseResponse;

class Download extends BaseResponse
{
    public $access_token;

    public $content;

    public $pageInfo;

    /**
     * @return bool
     */
    public function getIsSuccess()
    {
        return strcmp($this->code, 100) === 0;
    }

}