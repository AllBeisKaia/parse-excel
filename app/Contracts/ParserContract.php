<?php

namespace App\Contracts;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface ParserContract
{
    function getData(): Spreadsheet;

    function setData(): void;

    function rowCount(): int;

    function setReader(): void;
}