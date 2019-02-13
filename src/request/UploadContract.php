<?php


namespace choate\yii2\lovehaimi\request;


use choate\yii2\lovehaimi\BaseRequest;

class UploadContract extends BaseRequest
{
    /**
     * @var string
     */
    private $projectNo;

    /**
     * @var string
     */
    private $filename;

    public function __construct(string $projectNo, string $filename)
    {
        $this->filename = $filename;
        $this->projectNo = $projectNo;
    }

    public function getFilename() {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getProjectNo()
    {
        return $this->projectNo;
    }

    /**
     * @return array
     */
    protected function generateRequestBody()
    {
        return [
            'projectNo' => $this->getProjectNo()
        ];
    }

    protected function generateSignatureParams()
    {
        return [
            'projectNo' => $this->getProjectNo()
        ];
    }
}