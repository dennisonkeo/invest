<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    public $timestamps = false;

    public function package()
    {
    	return $this->belongsTo(Package::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
