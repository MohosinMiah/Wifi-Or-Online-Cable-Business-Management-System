<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    

     /**
     * Get the category for the post.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer','cust_id');

    }

}
