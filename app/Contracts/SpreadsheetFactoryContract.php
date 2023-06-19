<?php

namespace App\Contracts;

use App\Models\Excel\ParserBuilder;

interface SpreadsheetFactoryContract
{
    static function getParser(ParserBuilder $builder): ParserContract;
    static function getParserJob(ParserBuilder $builder): ParserJobContract;
    static function getBuilder(int $userId, string $fileName): ParserBuilderContract;
}