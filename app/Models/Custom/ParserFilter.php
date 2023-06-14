<?php

namespace App\Models\Custom;

class ParserFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function __construct(
        public int $step,
        public int $stepSize
    ) {}

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
