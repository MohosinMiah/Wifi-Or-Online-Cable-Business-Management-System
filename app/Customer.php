<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'reg_date', 'id_card','phone','address','wifi_plan','monthly_bill','payment_method'
    ];

    public function payments()
    {
        return $this->hasMany('App\Payment','cust_id');
    }
}
