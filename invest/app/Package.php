<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;

    public function packageUsers()
    {
    	return $this->hasMany(PackageUser::class);
    }
}
