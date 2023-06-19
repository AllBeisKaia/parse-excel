<?php

namespace App\Jobs;

use App\Models\Excel\ParserBuilder;
use App\Models\ExcelParserFactory as Factory;
use App\Models\Row;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use App\Contracts\ParserJobContract;

class ExcelParserJob implements ShouldQueue, ParserJobContract
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected null|string $fileName;
    protected null|int $rowsAmount;
    protected null|int $step;
    protected null|int $stepSize;
    protected null|array $structure;
    protected null|int $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(
        ParserBuilder $builder
    ) {
        $this->step = $builder->step;
        $this->fileName = $builder->fileName;
        $this->rowsAmount = $builder->rowsAmount;
        $this->stepSize = $builder->stepSize;
        $this->structure = $builder->structure;
        $this->userId = $builder->userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->batch()->cancelled()) {
            return;
        }

        $start = $this->step ? $this->step * $this->stepSize : 2;

        $builder = (Factory::getBuilder($this->userId, $this->fileName))
            ->setStep($this->step);
 
        $parser = Factory::getParser($builder);
        $parser->useFilter(
            Factory::getParserFiler($builder)
        );

        $parser->setData();

        $sheet = $parser->getActiveSheet();

        $rows = $sheet->rangeToArray(
            range: "A{$start}:" . $sheet->getHighestColumn() . $sheet->getHighestRow()
        );

        $process = 0;
        foreach($rows as $key => $r) {
            if(empty(array_filter($r))) continue;
            $status = ceil((($this->stepSize * $this->step + $key) / $this->rowsAmount) * 100);

            if($status > $process){
                $process = $status;
                Redis::publish("{$this->userId}:parser", $process);
            }

            $row = new Row();
            if(!empty($this->structure)) {
                $r = array_combine($this->structure, $r);
            }
            $row->data = json_encode($r, JSON_FORCE_OBJECT);
            $row->save();
        }
    }
}
