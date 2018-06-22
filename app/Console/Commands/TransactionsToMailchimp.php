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
     * @var array
     */
    private $dwsxe_field_list = [
        'dwsxe_ship_to_email_address' => 'EMAIL',
        'dwsxe_transaction_date'      => 'TX_DATE',
        'dwsxe_transaction_time'      => 'TX_TIME',
        'dwsxe_store'                 => 'STORE',
    ];

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

            $list_id = $user->merchantSettings->where('slug', MerchantSetting::MAILCHIMP_TRANSACTIONS_LIST_SLUG)->first()->key;

            $dwsxe_field_list_select = '`' . implode(
                '`, `',
                collect($this->dwsxe_field_list)->keys()->toArray()
            ) . '`';

            $query   = "SELECT $dwsxe_field_list_select FROM `dw_sls_xaction_dtl_e` WHERE `dwsxe_ship_to_email_address` <> ''";
            $members = collect(DB::connection('remote')->select($query))
                ->each(function ($item) {
                    $this->mapFieldsToTags($item);
                })
                ->unique('EMAIL');

            $result = (new MailchimpService($user))->batchSubscribe($list_id, $members);
            $this->warn('Importing ' . count($members) . ' transaction emails for merchant id = ' . $user->id . ', batch id = ' . $result['id']);
        }

        $this->info('Batch successfully dispatched to MailChimp.');
    }

    /**
     * @return mixed
     */
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

    /**
     * @param $obj
     * @return mixed
     */
    private function mapFieldsToTags($obj)
    {
        $fields = $this->dwsxe_field_list;
        $keys   = collect($fields)->keys()->toArray();

        foreach ($obj as $key => $value) {
            if (in_array($key, $keys)) {
                unset($obj->{$key});
                $obj->{$fields[$key]} = $value;
            }
        }

        return $obj;
    }
}
