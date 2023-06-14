<?php

namespace App\Jobs;

use App\Events\ParserStep;
use App\Models\Custom\FilteredParser;
use App\Models\Row;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpParser\Parser;

class ParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $fileName,
        protected int $rowsAmount,
        protected int $step,
        protected int $stepSize,
        protected bool $last = false,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $start = $this->step ? $this->step * $this->stepSize : 2;

        $file = new FilteredParser(
            fileName: $this->fileName,
            step: $this->step,
            stepSize: 1000
        );

        $sheet = $file->data->getActiveSheet();

        $rows = $sheet->rangeToArray(
            range: "A{$start}:" . $sheet->getHighestColumn() . $sheet->getHighestRow()
        );

        $process = 0;

        foreach($rows as $key => $r) {
            if(empty(array_filter($r))) continue;

            $status = ceil((($this->stepSize * $this->step + $key) / $this->rowsAmount) * 100);

            if($status > $process){
                $process = $status;
                Redis::publish('parser', $process);
            }

            $row = new Row();
            $row->name = $r[1];
            $row->date = date('Y-m-d H:i:s', ($r[2] - 25569) * 86400);
            $row->save();
        }

        if($this->last){
            unlink($this->fileName);
        }
    }
}
