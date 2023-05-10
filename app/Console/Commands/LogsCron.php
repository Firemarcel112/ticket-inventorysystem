<?php

namespace App\Console\Commands;
use App\Http\Controllers\ConfigController;
use App\Models\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class LogsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old logs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        DB::table('logs')
            ->whereDate('created_at', '<=', now()->subDays(ConfigController::LOGSUNTILDELETED)->setTime(0, 0, 0)->toDateTimeString())
            ->delete();
    }
}
