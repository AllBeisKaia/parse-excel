<?php

namespace App\Models\Custom;

use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class BaseExcelParser
{
    public null|IReader $reader;
    public null|Spreadsheet $data;

    protected string $fileName;

    public function rowsCount()
    {
        $rows = $this->data
            ->getActiveSheet()
            ->toArray()
        ;

        $i = 0;

        foreach($rows as $row){
            if(!array_filter($row)) continue;

            $i++;
        }

        return $i;
    }

    public function setData(): void
    {
        $this->data = $this->reader->load($this->fileName);
    }
}
