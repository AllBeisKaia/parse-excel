<?php

namespace App\Models\Excel;

use App\Contracts\ParserBuilderContract;

class ParserBuilder implements ParserBuilderContract
{
    public int $stepSize = 1000;
    public int $step = 0;

    public int $rowsAmount;

    public array $structure;

    public function __construct(
        public int $userId,
        public string $fileName
    ) {}

    public function setRowsAmount(int $rows)
    {
        $this->rowsAmount = $rows;
        return $this;
    }

    public function setStructure(array $structure)
    {
        $this->structure = $structure[0];
        return $this;
    }

    public function setStep(int $step)
    {
        $this->step = $step;
        return $this;
    }

    public function setStepSize(int $size)
    {
        $this->stepSize = $size;
        return $this;
    }
}