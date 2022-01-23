<?php

class ControllerCalculator
{

    private $x1;
    private $x2;
    private $operation;

    public function __construct(float $x1, float $x2, string $operation)
    {
        $this->x1 = $x1;
        $this->x2 = $x2;
        $this->operation = $operation;
    }

    public function getCalculation()
    {
        return Calculator::{$this->operation}($this->x1, $this->x2);
    }
}
