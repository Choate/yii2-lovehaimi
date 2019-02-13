<?php


namespace choate\yii2\lovehaimi\notify;


use choate\yii2\lovehaimi\signature\HmacMd5;
use yii\base\BaseObject;

class Notify extends BaseObject
{
    public $appId;

    public $projectNo;

    public $audiStatus;

    public $desc;

    public $term;

    public $amt;

    public $signvalue;

    private $verityStatus = false;

    /**
     * @param bool $status
     */
    public function setVerifyStatus(bool $status)
    {
        $this->verityStatus = $status;
    }

    /**
     * @return bool
     */
    public function getIsVerifySuccess()
    {
        return $this->verityStatus;
    }

    public function getSuccessResponse()
    {
        return [
            'code' => 100000,
            'msg' => 'OK',
        ];
    }

    public function getVerifyFailResponse()
    {
        return [
            'code' => 100003,
            'msg' => 'verify fail',
        ];
    }

    public function getNotFoundResponse()
    {
        return [
            'code' => 100001,
            'msg' => 'not found',
        ];
    }

    public function getFailResponse()
    {
        return [
            'code' => 100002,
            'msg' => 'fail',
        ];
    }

    /**
     * @return string
     */
    public function getSignatureString()
    {
        $params = $this->generateSignatureParams();
        ksort($params);
        $string = '';
        foreach ($params as $key => $value) {
            $string .= $key . $value;
        }

        return $string;
    }

    protected function generateSignatureParams()
    {
        return [
            'appId' => $this->appId,
            'projectNo' => $this->projectNo,
            'audiStatus' => $this->audiStatus,
            'desc' => $this->desc,
            'term' => $this->term,
            'amt' => $this->amt,
        ];
    }

}