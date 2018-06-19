<?php

namespace App\Console\Commands;

use App\Models\MerchantSetting;
use App\Services\MailchimpService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CustomersToMailchimp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports customers\' email list to Mailchimp from POS database';

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
        $users = $this->getUsers();

        foreach ($users as $user) {
            setRemoteConnection($user->pos_wan_address, $user);

            $query   = "SELECT DISTINCT `cx_email_address` FROM `CX` WHERE `cx_email_address` <> ''";
            $emails  = collect(DB::connection('remote')->select($query))->pluck('cx_email_address');
            $list_id = $user->merchantSettings->where('slug', MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG)->first()->key;

            $result = (new MailchimpService($user))->batchSubscribe($list_id, $emails);
            $this->warn('Importing ' . count($emails) . ' emails for user_id: ' . $user->id);
        }

        $this->info('Complete');
    }

    private function getUsers()
    {
        $users = User::with('merchantSettings')
            ->where([
                ['pos_wan_address', '<>', ''],
                ['pos_mysql_un', '<>', ''],
                ['pos_mysql_pw', '<>', ''],
                ['db_name', '<>', ''],
            ])
            ->whereHas('merchantSettings', function ($query) {
                $query->where([
                    ['slug', MerchantSetting::MAILCHIMP_TOKEN_SLUG],
                    ['value', '<>', ''],
                ]);
            })
            ->whereHas('merchantSettings', function ($query) {
                $query->where([
                    ['slug', MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG],
                    ['key', '<>', ''],
                ]);
            })->get();

        return $users;
    }
}
