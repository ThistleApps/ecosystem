<?php

namespace App\Console\Commands;

use App\Models\MerchantSetting;
use App\Services\MailchimpService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransactionsToMailchimp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports transactions\' email list to Mailchimp from POS database';

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

            $query   = "SELECT DISTINCT `dwsxe_ship_to_email_address` FROM `dw_sls_xaction_dtl_e` WHERE `dwsxe_ship_to_email_address` <> ''";
            $emails  = collect(DB::connection('remote')->select($query))->pluck('dwsxe_ship_to_email_address');
            $list_id = $user->merchantSettings->where('slug', MerchantSetting::MAILCHIMP_TRANSACTIONS_LIST_SLUG)->first()->key;

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
                    ['slug', MerchantSetting::MAILCHIMP_TRANSACTIONS_LIST_SLUG],
                    ['key', '<>', ''],
                ]);
            })->get();

        return $users;
    }
}
