<?php

namespace Stats\Interfaces;

interface StatsInterface
{
    public function setName(string $name);
    public function setValue(int $value);
    public function getName();
    public function getValue();
}
