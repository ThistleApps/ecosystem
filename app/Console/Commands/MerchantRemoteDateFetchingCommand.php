<?php

namespace App\Console\Commands;

use App\Jobs\MerchantDataTransectionJob;
use App\User;
use Illuminate\Console\Command;

class MerchantRemoteDateFetchingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'merchant-remote-data-fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user)
            dispatch(new MerchantDataTransectionJob($user));


        $this->info('All the Users Remote Data Fetch with the blend app');

    }
}
