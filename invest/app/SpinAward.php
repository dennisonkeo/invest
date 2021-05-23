<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpinAward extends Model
{
	public $timestamps = false;

    protected $table = "spin_awards";

     public function spinAwards()
    {
        return $this->belongsTo(User::class);
    }
}
