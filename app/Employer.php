<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
	/**
	 * Fillable fields for an employer.
	 *
	 * @var array
	 */
    protected $fillable = [
        'business_name',
        'business_category',
        'business_contact',
        'business_website',
        'location',
        'street',
        'city',
        'zip',
        'state',
        'company_intro',
        'business_logo',
    ];

    public function scopeFindEmployer($query, $id, $business_name)
    {
        return $query->where(compact('id', 'business_name'));
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function adverts()
    {
    	return $this->hasMany(Advert::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'employer_id');
    }

    public function ownRatings()
    {
        return $this->hasMany(EmployerRating::class);
    }

    public function ratings()
    {
        return $this->hasMany(JobSeekerRating::class);
    }

    public function logoBy(User $user)
    {
        $employerID = $user->employer()->first()->id;

        if(!$employerID)
        {
            return null;
        }

        return $this->id == $employerID;
    }

    public function currentLogo()
    {
        if( ($this->business_logo != null) && ($this->business_logo != "") && ($this->business_logo != "/images/defaults/default.jpg") )
        {
            $givenLogo = $this->business_logo;

        }else{
            
            $givenLogo = "/images/defaults/default.jpg";
        }

        return $givenLogo;
    }
}
