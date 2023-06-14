<?php

namespace App\Models\Custom;

use PhpOffice\PhpSpreadsheet\IOFactory;

class FilteredParser extends BaseExcelParser
{
    public function __construct(
        protected string $fileName,
        public int $step,
        public int $stepSize
    ) {
        $filter = new ParserFilter(step: $this->step, stepSize: $this->stepSize);

        $this->reader = IOFactory::createReader(IOFactory::identify($fileName))
            ->setReadDataOnly(true)
            ->setReadEmptyCells(true)
            ->setReadFilter($filter)
        ;

        $this->setData();
    }
}
