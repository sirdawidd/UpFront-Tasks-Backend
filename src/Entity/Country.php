<?php declare(strict_types=1);

namespace Taxation\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Country
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var ArrayCollection */
    protected $states;

    public function __construct(array $params)
    {
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->states = new ArrayCollection();
        foreach ($params['states'] as $state) {
            $stateEntity = new State($state);
            foreach ($state['counties'] as $county) {
                $countyEntity = new County($county);
                $countyEntity->addTaxRate(new TaxRate($county['taxRate']));
                $stateEntity->addCounty($countyEntity);
            }
            $this->addState($stateEntity);
        }
    }

    public function addState(State $state): self
    {
        if (!$this->states->contains($state)) {
            $this->states[] = $state;
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
    public function getStates(): ArrayCollection
    {
        return $this->states;
    }

    public function getTotalTaxAmount(): float
    {
        $totalTaxAmount = 0;
        foreach ($this->getStates() as $state) {
            $totalTaxAmount += $state->getTotalTaxAmount();
        }

        return round($totalTaxAmount, 2);
    }

    public function getAvgTaxRate(): float
    {
        $totalCountryTaxRates = 0;
        foreach ($this->getStates() as $state) {
            $totalCountryTaxRates += $state->getAvgTaxRate();
        }

        return round($totalCountryTaxRates / $this->getStates()->count(), 2);
    }
}