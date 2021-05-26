<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function createToken($user_id,$name, array $scopes = [])
{
    return Container::getInstance()->make(PersonalAccessTokenFactory::class)
    ->make(
        $user_id, $name, $scopes
    );
}

    public function payMethods()
    {
        return $this->hasMany(UserPaymentMethod::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function spinAwards()
    {
        return $this->hasMany(SpinAward::class);
    } 

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function packageUsers()
    {
        return $this->hasMany(PackageUser::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
