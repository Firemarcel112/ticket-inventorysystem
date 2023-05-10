<?php

namespace App\Console\Commands;

use App\Http\Controllers\ConfigController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ArchiveCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old archived tickets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('ticketarchive')->whereDate('created_at', '<=', now()->subDays(ConfigController::DAYSUNTILDELETED)->setTime(0, 0, 0)->toDateTimeString())->delete();
        DB::table('ticketarchivemessages')->whereDate('created_at', '<=', now()->subDays(ConfigController::DAYSUNTILDELETED)->setTime(0, 0, 0)->toDateTimeString())->delete();

    }
}
