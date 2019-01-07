<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Traits\HasRoles;


class User extends Authenticatable
{
    use HasRoles, Billable, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar','contact', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // identify the date to make carbon instance
    protected $dates = ['trial_ends_at','plan_ends_at'];


    /**
     * Set the password attribute.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    /**
     * defining "users" table relationship with "job_seekers" table
     */
    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function avatarBy(User $user)
    {
        $userID = $user->id;

        if(!$userID)
        {
            return null;
        }

        return $this->id == $userID;
    }

    public function currentAvatar()
    {
        if( ($this->avatar != null) && ($this->avatar != "") && ($this->avatar != "/images/defaults/default.jpg") )
        {
            $givenAvatar = $this->avatar;

        }else{

            $givenAvatar = "/images/defaults/default.jpg";
        }

        return $givenAvatar;
    }
}
