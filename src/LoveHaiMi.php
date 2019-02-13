<?php


namespace choate\yii2\lovehaimi;


use choate\yii2\lovehaimi\notify\Notify;
use choate\yii2\lovehaimi\request\CreateOrder;
use choate\yii2\lovehaimi\request\UploadContract;
use choate\yii2\lovehaimi\response\Contract;
use choate\yii2\lovehaimi\response\Download;
use choate\yii2\lovehaimi\response\Response;
use choate\yii2\lovehaimi\signature\HmacMd5;
use yii\authclient\InvalidResponseException;
use yii\base\Component;
use yii\di\Instance;
use yii\httpclient\Client;
use Yii;

class LoveHaiMi extends Component
{

    public $baseUrl = 'http://sdk-uat.lovehaimi.com/sdk-web-haimi';

    public $paymentUrl = '/merchant/open/submitOrder/direct';

    public $uploadContractUrl = '/merchant/open/receiveContract';

    public $appId;

    public $key;

    private $httpClient;

    /**
     * @param CreateOrder $order
     * @return Download
     * @throws InvalidResponseException
     */
    public function createOrder(CreateOrder $order)
    {
        $hmacMd5 = new HmacMd5();
        $signatureString = $order->getSignatureString($this->appId);
        $signature = $hmacMd5->generateSignature($signatureString, $this->key);
        $request = $this->createRequest();
        $request->setMethod('POST')
            ->setData($order->getRequestBody($this->appId, $signature))
            ->setFormat(Client::FORMAT_JSON);

        return new Download($this->sendRequest($request));
    }

    /**
     * @param UploadContract $uploadContract
     * @return Contract
     * @throws InvalidResponseException
     */
    public function uploadContract(UploadContract $uploadContract)
    {
        $hmacMd5 = new HmacMd5();
        $signatureString = $uploadContract->getSignatureString($this->appId);
        $signature = $hmacMd5->generateSignature($signatureString, $this->key);
        $request = $this->createRequest();
        $request->setMethod('POST')
            ->setData($uploadContract->getRequestBody($this->appId, $signature))
            ->addFile('file', $uploadContract->getFilename());

        return new Contract($this->sendRequest($request));
    }

    /**
     * @param array $data
     * @return Notify
     */
    public function notify(array $data)
    {
        $notify = new Notify($data);
        $hmacMd5 = new HmacMd5();
        $signatureString = $notify->getSignatureString();
        $notify->setVerifyStatus($hmacMd5->verify($notify->signvalue, $signatureString, $this->key));

        return $notify;
    }

    /**
     * @return \yii\httpclient\Request
     */
    protected function createRequest()
    {
        return $this->getHttpClient()
            ->createRequest()
            ->addOptions($this->defaultRequestOptions());
    }

    /**
     * @param \yii\httpclient\Request $request
     * @return array
     * @throws InvalidResponseException
     */
    protected function sendRequest($request)
    {
        $response = $request->send();

        if (!$response->getIsOk()) {
            throw new InvalidResponseException($response, 'Request failed with code: ' . $response->getStatusCode() . ', message: ' . $response->getContent());
        }

        return $response->getData();
    }

    /**
     * @return \yii\httpclient\Client
     */
    protected function getHttpClient()
    {
        if (!is_object($this->httpClient)) {
            $this->httpClient = $this->createHttpClient($this->httpClient);
        }
        return $this->httpClient;
    }

    /**
     * @param object|string|array|static $reference
     * @return \yii\httpclient\Client
     */
    protected function createHttpClient($reference)
    {
        $httpClient = Instance::ensure($reference, Client::class);
        $httpClient->baseUrl = $this->baseUrl;

        return $httpClient;
    }

    /**
     * @return array
     */
    protected function defaultRequestOptions()
    {
        return [
            'timeout' => 30,
            'sslVerifyPeer' => false,
        ];
    }
}