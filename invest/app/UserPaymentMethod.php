<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    protected $table = "payment_methods";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
