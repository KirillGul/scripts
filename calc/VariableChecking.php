<?php

class VariableChecking
{
    private $x1;
    private $x2;
    private $operation;

    public function __construct(int $x1, int $x2, string $operation)
    {
        $this->x1 = $x1;
        $this->x2 = $x2;
        $this->operation = $operation;
    }

    public function cheking()
    {
        if (!is_numeric($this->x1)) {
            throw new ValidateNumericException("$this->x1 не является числом.");
        }

        if (!is_numeric($this->x2)) {
            throw new ValidateNumericException("$this->x2 не является числом.");
        }

        if ($this->operation === 'divide' && $this->x2 === 0) {
            throw new ValidateNumericException("На ноль делить нельзя!");
        }

        return 1;
    }
}
