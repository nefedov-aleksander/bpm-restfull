<?php
namespace BpmRestfull\Definition\CaseDefinition;

use BpmRestfull\Definition\Arrayable;

class Sla implements Arrayable
{
    
    private $dateFormat = 'Y-m-d\TH:m:s';

    private $description = '';

    private $startDate = null;

    private $planEndDate = null;

    private $factEndDate = null;

    private $workHours = '';

    private $delay = 0;

    public function __construct(string $dateFormat = 'Y-m-d\TH:i:s')
    {
        $this->dateFormat = $dateFormat;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function isStartDate(): bool
    {
        return $this->startDate != null;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function isPlanEndDate(): bool
    {
        return $this->planEndDate != null;
    }

    public function getPlanEndDate(): ?\DateTime
    {
        return $this->planEndDate;
    }

    public function setPlanEndDate(\DateTime $planEndDate)
    {
        $this->planEndDate = $planEndDate;
    }

    public function isFactEndDate(): bool
    {
        return $this->factEndDate != null;
    }

    public function getFactEndDate(): ?\DateTime
    {
        return $this->factEndDate;
    }

    public function setFactEndDate(\DateTime $factEndDate)
    {
        $this->factEndDate = $factEndDate;
    }

    public function getWorkHours(): string
    {
        return $this->workHours;
    }

    public function setWorkHours(string $workHours)
    {
        $this->workHours = $workHours;
    }

    public function getDelay(): float
    {
        return $this->delay;
    }

    public function setDelay(float $delay)
    {
        $this->delay = $delay;
    }

    public function toArray() : array
    {
        return [
            'SlaDescription' => $this->getDescription(),
            'SlaStartDate' => $this->isStartDate() ? $this->getStartDate()->format($this->dateFormat) : null,
            'SlaPlanEndDate' => $this->isPlanEndDate() ? $this->getPlanEndDate()->format($this->dateFormat) : null,
            'SlaFactEndDate' => $this->isFactEndDate() ? $this->getFactEndDate()->format($this->dateFormat) : null,
            'SlaWorkHours' => $this->getWorkHours(),
            'SlaDelay' => $this->getDelay()
        ];
    }
}