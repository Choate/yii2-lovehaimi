<?php


namespace choate\yii2\lovehaimi\request;


use choate\yii2\lovehaimi\BaseRequest;

class CreateOrder extends BaseRequest
{
    /**
     * @var string
     */
    private $projectNo;

    /**
     * @var string
     */
    private $mobile;

    /**
     * @var int
     */
    private $applyAmt;

    /**
     * @var int
     */
    private $applyTerm;

    /**
     * @var string
     */
    private $orderDate;

    /**
     * @var string
     */
    private $merProductNo;

    /**
     * @var string
     */
    private $commodityName;

    /**
     * @var string
     */
    private $contractNo;

    /**
     * @var string
     */
    private $studentName;

    /**
     * @var string
     */
    private $relation;

    /**
     * @var string
     */
    private $applicantName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $homeAddress;

    public function __construct(string $projectNo, int $applyAmount, int $applyTerm, string $orderDate, string $merProductNo, string $commodityName, string $contractNo)
    {
        $this->projectNo = $projectNo;
        $this->applyAmt = $applyAmount;
        $this->applyTerm = $applyTerm;
        $this->orderDate = $orderDate;
        $this->merProductNo = $merProductNo;
        $this->commodityName = $commodityName;
        $this->contractNo = $contractNo;
    }

    public function setStudentInfo(string $studentName, string $applicantName, string $mobile, string $homeAddress)
    {
        $this->studentName = $studentName;
        $this->applicantName = $applicantName;
        $this->mobile = $mobile;
        $this->homeAddress = $homeAddress;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setRelation(string $relation)
    {
        $this->relation = $relation;
    }

    /**
     * @return string
     */
    public function getProjectNo(): string
    {
        return $this->projectNo;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @return int
     */
    public function getApplyAmt(): int
    {
        return $this->applyAmt;
    }

    /**
     * @return int
     */
    public function getApplyTerm(): int
    {
        return $this->applyTerm;
    }

    /**
     * @return string
     */
    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    /**
     * @return string
     */
    public function getMerProductNo(): string
    {
        return $this->merProductNo;
    }

    /**
     * @return string
     */
    public function getCommodityName(): string
    {
        return $this->commodityName;
    }

    /**
     * @return string
     */
    public function getContractNo(): string
    {
        return $this->contractNo;
    }

    /**
     * @return string
     */
    public function getStudentName(): string
    {
        return $this->studentName;
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @return string
     */
    public function getApplicantName(): string
    {
        return $this->applicantName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getHomeAddress(): string
    {
        return $this->homeAddress;
    }

    protected function generateRequestBody()
    {
        $this->generateSignatureParams();
    }

    protected function generateSignatureParams()
    {
        return array_filter([
            'projectNo' => $this->getProjectNo(),
            'mobile' => $this->getMobile(),
            'applyAmt' => $this->getApplyAmt(),
            'applyTerm' => $this->getApplyTerm(),
            'orderDate' => $this->getOrderDate(),
            'merProductNo' => $this->getMerProductNo(),
            'commodityName' => $this->getCommodityName(),
            'contractNo' => $this->getContractNo(),
            'studentName' => $this->getStudentName(),
            'applicantName' => $this->getApplicantName(),
            'relation' => $this->getRelation(),
            'email' => $this->getEmail(),
            'homeAddress' => $this->getHomeAddress(),
        ], function ($value) {
            return !$this->isEmpty($value);
        });
    }
}