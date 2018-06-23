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
     * @var array
     */
    private $cx_field_list = [
        'cx_email_address'     => 'EMAIL',
        'cx_auth_to_chrg_name' => 'AUTH_TO_CH',
        'cx_customer'          => 'CUSTOMER',
    ];

    /**
     * @var array
     */
    private $cr_related_field_list = [
        'cr_customer'              => 'CUST_NUM',
        'cr_name'                  => 'NAME',
        'cr_street_1'              => 'STREET_1',
        'cr_street_2'              => 'STREET_2',
        'cr_city'                  => 'CITY',
        'cr_state'                 => 'STATE',
        'cr_country'               => 'COUNTRY',
        'cr_contact'               => 'CONTACT',
        'cr_area_code'             => 'AREA_CODE',
        'cr_phone'                 => 'PHONE',
        'cr_net_sales_running_bal' => 'NET_SALES',
        'cr_bal_current'           => 'BAL_CURR',
        'cr_bal_aged1'             => 'BAL_OVR30',
        'cr_bal_aged2'             => 'BAL_OVR60',
        'cr_bal_aged3'             => 'BAL_OVR90',
        'cr_bal_aged4'             => 'BAL_OVR120',
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

            $list_id = $user->merchantSettings->where('slug', MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG)->first()->key;

            // Note: if query fails make sure ONLY_FULL_GROUP_BY is _NOT_ set
            // > SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

            $cx_field_list_select = '`' . implode(
                '`, `',
                collect($this->cx_field_list)->keys()->toArray()
            ) . '`';
            $cr_field_list_select = '`' . implode(
                '`, `',
                collect($this->cr_related_field_list)->keys()->toArray()
            ) . '`';

            $query   = "SELECT $cx_field_list_select, $cr_field_list_select FROM `CX` LEFT JOIN `CR` ON `cx_customer`=`cr_customer` WHERE `cx_email_address` <> ''";
            $members = collect(DB::connection('remote')->select($query))
                ->each(function ($item) {
                    $this->mapFieldsToTags($item);
                })
                ->unique('EMAIL');

            $result = (new MailchimpService($user))->batchSubscribe($list_id, $members);
            $this->warn('Importing ' . count($members) . ' customer emails for merchant id = ' . $user->id . ', batch id = ' . $result['id']);
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
                    ['slug', MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG],
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
        $fields = array_merge($this->cx_field_list, $this->cr_related_field_list);
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
