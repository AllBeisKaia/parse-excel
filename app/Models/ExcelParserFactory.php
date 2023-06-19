<?php

namespace App\Models;

use App\Contracts\SpreadsheetFactoryContract;
use App\Jobs\ExcelParserJob;
use App\Models\Excel\ExcelParser;
use App\Models\Excel\ParserBuilder;
use App\Models\Excel\ParserFilter;

class ExcelParserFactory implements SpreadsheetFactoryContract
{
    public static function getParser(ParserBuilder $builder): ExcelParser
    {
        return new ExcelParser($builder);
    }

    public static function getParserJob(ParserBuilder $builder): ExcelParserJob
    {
        return new ExcelParserJob($builder);
    }

    public static function getParserFiler(ParserBuilder $builder): ParserFilter
    {
        return new ParserFilter($builder);
    }

    public static function getBuilder(int $userId, string $fileName): ParserBuilder
    {
        return new ParserBuilder(userId: $userId, fileName: $fileName);
    }
}