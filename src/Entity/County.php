<?php declare(strict_types=1);

namespace Taxation\Entity;

class County
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var TaxRate */
    protected $taxRate;

    public function __construct(array $params)
    {
        $this->id = $params['id'];
        $this->name = $params['name'];
    }

    public function addTaxRate(TaxRate $taxRate): self
    {
        if (!$this->taxRate) {
            $this->taxRate = $taxRate;
        }

        return $this;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return TaxRate
     */
    public function getTaxRate(): TaxRate
    {
        return $this->taxRate;
    }
}