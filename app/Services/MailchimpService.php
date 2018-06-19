<?php

namespace App\Services;

use App\Models\MerchantSetting;
use App\User;
use DrewM\MailChimp\Batch;
use DrewM\MailChimp\MailChimp as MailchimpAPI;
use ExpandOnline\OAuth2\Client\Provider\Mailchimp as MailchimpOAuth2;
use League\OAuth2\Client\Token\AccessToken;

class MailchimpService
{
    /**
     * @var mixed
     */
    public $provider;

    /**
     * @var mixed
     */
    public $isValidToken;

    /**
     * @var mixed
     */
    private $api;

    /**
     * @var mixed
     */
    private $token;

    /**
     * @var mixed
     */
    private $owner;

    /**
     * @var mixed
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user     = $user;
        $this->provider = new MailchimpOAuth2([
            'clientId'     => config('services.mailchimp.client_id'),
            'clientSecret' => config('services.mailchimp.client_secret'),
            'redirectUri'  => route('configurator.mailchimp.auth'),
        ]);
        $this->token        = $this->user->merchantSettings->where('slug', MerchantSetting::MAILCHIMP_TOKEN_SLUG)->first();
        $this->isValidToken = $this->validateToken();
        $this->api          = $this->newAPIClient();
    }

    /**
     * @param $list_id
     * @param $emails
     * @return mixed
     */
    public function batchSubscribe($list_id, $emails)
    {
        if (!$this->api) {
            return null;
        }

        \Log::debug('Started');

        try {
            $batch = $this->api->new_batch();

            foreach ($emails as $key => $email) {
                \Log::debug('Email '.$key.': ' . $email);
                $batch->post("op$key", "/lists/$list_id/members", [
                    'email_address' => $email,
                    'status'        => 'subscribed',
                ]);
            }


            $result = $batch->execute();
        } catch (Exception $e) {
            report($e);
        }

        return $result;
    }

    /**
     * @return MailchimpAPI
     */
    private function newAPIClient()
    {
        if (!$this->isValidToken) {
            return null;
        }

        return new MailchimpAPI($this->token->value . '-' . $this->token->key);
    }

    /**
     * @return mixed
     */
    public function getLists()
    {
        $lists = $this->api->get('lists');

        return $lists;
    }

    /**
     * @return bool
     */
    private function validateToken()
    {
        // Early return if token doesn't exist.
        if (!$this->token) {
            return false;
        }

        try {
            $owner = $this->provider->getResourceOwner(
                new AccessToken(['access_token' => $this->token->value])
            )->toArray();
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            report($e);
        }

        // If token is no longer valid or permission is revoked delete token.
        if (isset($owner['error']) && $owner['error'] === 'invalid_token') {
            $this->user->merchantSettings()->where('id', $this->token->id)->delete();
            $this->token = null;

            return false;
        }

        return true;
    }
}
