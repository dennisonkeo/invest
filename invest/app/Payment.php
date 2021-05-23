<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;

    protected $table = "payment";

    public function user()
    {
    	return $this->belongsTo(User::clas);
    }
}
