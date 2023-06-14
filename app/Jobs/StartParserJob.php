<?php

namespace App\Jobs;

use App\Models\Custom\ExcelParser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $fileName,
        protected int $userId,
        protected int $stepSize = 1000,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = new ExcelParser($this->fileName);
        $rows = $file->rowsCount();

        $stepsCount = (int) floor($rows / $this->stepSize);

        $last = false;

        for($i = 0; $i <= $stepsCount; $i++) {
            if($i === $stepsCount) $last = true;

            ParserJob::dispatch(
                fileName: $this->fileName,
                rowsAmount: $rows,
                step: $i,
                stepSize: $this->stepSize,
                last: $last
            );
        }
    }
}
