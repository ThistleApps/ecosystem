<?php

namespace App;

use App\Models\PosType;
use App\Models\OrderDetail;
use App\Models\OrderHeader;
use App\Models\MerchantSetting;
use App\Models\StoreInformation;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'first_name',
        'last_name',
        'business_name',
        'primary_affiliate',
        'primary_affiliate_number',
        'pos_type',
        'pos_wan_address',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
        'pos_mysql_un',
        'pos_mysql_pw',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at'        => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];

    public function getNameAttribute($value)
    {
        if (is_null($this->attributes['name']) or empty(trim($this->attributes['name']))) {
            return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
        } else {
            return $value;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function posType()
    {
        return $this->hasOne(PosType::class, 'id', 'pos_type');
    }

    /**
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return $role ? $this->roles()->where('name', $role)->exists() : false;
    }

    public function orderHeaders()
    {
        return $this->hasMany(OrderHeader::class);
    }

    public function storeInformation()
    {
        return $this->hasMany(StoreInformation::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function merchantSettings()
    {
        return $this->hasMany(MerchantSetting::class);
    }

    public function getMerchantGetswiftKey()
    {
        $getswift_key = $this->merchantSettings()->where('slug', MerchantSetting::GETSWIFT_KEY_SLUG)
            ->first();

        return isset($getswift_key->key) ? $getswift_key->key : null;
    }

    public function getMailchimpToken()
    {
        return $this->merchantSettings()
            ->where('slug', MerchantSetting::MAILCHIMP_TOKEN_SLUG)
            ->first('value');
    }
}
