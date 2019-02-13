<?php


namespace choate\yii2\lovehaimi;


use yii\base\BaseObject;

abstract class BaseRequest
{
    /**
     * @param string $appId
     * @return string
     */
    public function getSignatureString(string $appId)
    {
        $params = $this->generateSignatureParams();
        $params['appId'] = $appId;
        ksort($params);
        $string = '';
        foreach ($params as $key => $value) {
            $string .= $key . $value;
        }

        return $string;
    }

    /**
     * @param string $appId
     * @param string $signature
     * @return array
     */
    public function getRequestBody(string $appId, string $signature)
    {
        $params = $this->generateRequestBody();
        $params['appId'] = $appId;
        $params['signature'] = $signature;

        return $params;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isEmpty($value)
    {
        return empty($value) && !is_numeric($value);
    }

    /**
     * @return array
     */
    abstract protected function generateRequestBody();

    /**
     * @return array
     */
    abstract protected function generateSignatureParams();
}