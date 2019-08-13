<?php declare(strict_types=1);

namespace Taxation\Entity;

class TaxRate
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $code;
    /** @var int */
    protected $rate;
    /** @var float */
    protected $taxAmount;

    public function __construct(array $params)
    {
        $this->id = $params['id'];
        $this->code = $params['code'];
        $this->rate = $params['rate'];
        $this->taxAmount = $params['taxAmount'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }
}