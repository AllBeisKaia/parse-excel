<?php

namespace App\Models\Custom;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelParser extends BaseExcelParser
{
    public function __construct(
        protected string $fileName,
    ) {
        $this->reader = IOFactory::createReader(IOFactory::identify($this->fileName))
            ->setReadDataOnly(true)
        ;

        $this->setData();
    }
}
