<?php

namespace Stats;
use Helper\GeneralHelper;
use Stats\Interfaces\StatsInterface;

class Stats implements StatsInterface
{
    public string $name = "";
    public int $value = 0;

    public function __construct($min = null, $max = null)
    {
        if ($min != null && $max != null) {
            $this->setValue(GeneralHelper::getValueBetween($min, $max));
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}