<?php

namespace App\Models\Excel;

use App\Contracts\ParserContract;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelParser implements ParserContract
{
    protected string $fileName;

    protected null|IReader $reader;
    protected null|Spreadsheet $data;

    protected int $rowsAmount = 0;
    protected int $stepSize = 1000;

    public function __construct(ParserBuilder $builder)
    {
        $this->fileName = $builder->fileName;
        $this->stepSize = $builder->stepSize;

        $this->setReader();
    }

    public function headRow(): array
    {
        $sheet = $this->data->getActiveSheet();

        $head = $sheet->rangeToArray(
            range: "A1:" . $sheet->getHighestColumn() . 1
        );

        return $head;
    }

    public function setReader(): void
    {
        $this->reader = IOFactory::createReader(IOFactory::identify($this->fileName))
            ->setReadDataOnly(true)
        ;
    }

    public function setData(): void
    {
        $this->data = $this->reader->load($this->fileName);
    }

    public function getData(): Spreadsheet
    {
        if(empty($this->data)) {
            $this->setData();
        }
        return $this->data;
    }

    public function getActiveSheet()
    {
        return $this->data->getActiveSheet();
    }

    public function useFilter(IReadFilter $filter): void
    {
        $this->reader->setReadDataOnly(true)
            ->setReadEmptyCells(true)
            ->setReadFilter($filter);
    }

    public function rowCount(): int
    {
        if(!$this->rowsAmount) {
            $rows = $this->getActiveSheet()
                ->toArray();

            $i = 0;
            foreach($rows as $row){
                if(!array_filter($row)) continue;
                $i++;
            }

            $this->rowsAmount = $i;
        }

        return $this->rowsAmount;
    }
}
