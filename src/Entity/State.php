<?php declare(strict_types=1);

namespace Taxation\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class State
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var ArrayCollection */
    protected $counties;

    public function __construct(array $params)
    {
        $this->name = $params['name'];
        $this->id = $params['id'];
        $this->counties = new ArrayCollection();
    }

    public function addCounty(County $county): self
    {
        if (!$this->counties->contains($county)) {
            $this->counties[] = $county;
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
     * @return ArrayCollection
     */
    public function getCounties(): ArrayCollection
    {
        return $this->counties;
    }

    public function getAvgTaxRate(): float
    {
        $totalStateTaxRates = 0;
        foreach ($this->getCounties() as $county) {
            $totalStateTaxRates += $county->getTaxRate()->getRate();
        }

        return round($totalStateTaxRates / $this->getCounties()->count(), 2);
    }

    public function getAverageTaxAmount(): float
    {
        return round($this->getTotalTaxAmount() / $this->getCounties()->count(), 2);
    }

    public function getTotalTaxAmount(): float
    {
        $totalTaxAmount = 0;
        foreach ($this->getCounties() as $county) {
            $totalTaxAmount += $county->getTaxRate()->getTaxAmount();
        }

        return round($totalTaxAmount, 2);
    }
}