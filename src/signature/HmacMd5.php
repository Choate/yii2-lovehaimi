<?php


namespace choate\yii2\lovehaimi\signature;


use yii\base\BaseObject;

class HmacMd5 extends BaseObject
{

    public function generateSignature($baseString, $key)
    {
        return md5($baseString . $key);
    }


    public function verify($signature, $baseString, $key)
    {
        $expectedSignature = $this->generateSignature($baseString, $key);
        if (empty($signature) || empty($expectedSignature)) {
            return false;
        }

        return (strcmp($expectedSignature, $signature) === 0);
    }
}