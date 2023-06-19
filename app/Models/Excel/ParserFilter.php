<?php

namespace App\Models\Excel;

class ParserFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    protected int $step;
    protected int $stepSize;

    public function __construct(ParserBuilder $builder)
    {
        $this->step = $builder->step;
        $this->stepSize = $builder->stepSize;
    }

    /**
     * @inheritDoc
     */
    public function readCell($columnAddress, $row, $worksheetName = '')
    {
        if($this->step) {
            if ($row >= ($this->step * $this->stepSize) && $row <= (($this->step + 1) * $this->stepSize)) {
                return true;
            }
        } else {
            if ($row <= $this->stepSize) {
                return true;
            }
        }

        return false;
    }
}
