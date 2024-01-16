<?php

namespace App\Console\Commands;

use App\Jobs\PreparedData;
use Illuminate\Console\Command;

class GetDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда загрузки данных';

    /**
     * Execute the console command.
     */
    public function handle():void
    {
        //
        PreparedData::dispatchSync();

    }
}
