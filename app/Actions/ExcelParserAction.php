<?php

namespace App\Actions;

use App\Models\ExcelParserFactory as Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class ExcelParserAction
{
    public function __invoke($fileName)
    {
        $builder = Factory::getBuilder(Auth::id(), $fileName);
        $parser = Factory::getParser($builder);
        $parser->setData();

        $builder->setRowsAmount($parser->rowCount())
            ->setStructure($parser->headRow())
            ->setStepSize(1000);

        $stepsCount = $builder->rowsAmount / $builder->stepSize;

        $batches = [];
        for($i = 0; $i <= $stepsCount; $i++) {
            $builder->step = $i;
            $batches[] = Factory::getParserJob($builder);
        }

        Bus::batch($batches)
            ->then(function () use ($fileName) {
                unlink($fileName);
            })->dispatch();
    }
}