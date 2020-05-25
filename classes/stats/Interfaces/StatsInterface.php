<?php

namespace Stats\Interfaces;

interface StatsInterface
{
    public function setName($name);
    public function setValue($value);
    public function getName();
    public function getValue();
}
