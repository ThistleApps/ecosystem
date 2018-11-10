<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Spyglass Retail',
        'product' => 'Spyglass Retail Subscription',
        'street' => '7209 Lancaster Pike',
        'location' => 'Hockessin, DE 19707',
        'phone' => '302-481-6515',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = [
        'admin@spyglassretail.com',
    ];

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'admin@spyglassretail.com',
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = false;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        try
        {
            $admin_emails = User::query()->whereHas('roles' , function ($q){
                $q->where('name' , 'Admin');
            })->pluck('email')->toArray();

        }catch (\Exception $exception)
        {
            $admin_emails = [];
        }

        Spark::developers(array_merge($admin_emails , $this->developers));

        Spark::afterLoginRedirectTo('/settings');

        Spark::validateUsersWith(function () {
            return [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'business_name' => 'required|max:255',
                'primary_affiliate' => 'required|max:255',
                'primary_affiliate_number' => 'required|max:255',
                'pos_type' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'vat_id' => 'max:50|vat_id',
                'terms' => 'required|accepted',

            ];
        });

        Spark::createUsersWith(function ($request) {
            $user = Spark::user();

            $data = $request->all();

            $user->forceFill([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'business_name' => $data['business_name'],
                'primary_affiliate' => $data['primary_affiliate'],
                'primary_affiliate_number' => $data['primary_affiliate_number'],
                'pos_type' => $data['pos_type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'last_read_announcements_at' => Carbon::now(),
                'trial_ends_at' => Carbon::now()->addDays(Spark::trialDays()),
            ])->save();

            return $user;
        });

        Spark::useStripe()->noCardUpFront()->trialDays(10);

        Spark::freePlan()
            ->features([
                'trail'
            ]);

        Spark::plan('Basic', 'provider-id-1')
            ->price(10)
            ->features([
                'merchant-basic'
            ]);
    }
}
