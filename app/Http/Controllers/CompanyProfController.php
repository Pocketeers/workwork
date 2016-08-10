<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Advert;
use App\Employer;
use App\jobSeeker;
use App\Job_Seeker_Rating;
use App\Employer_Rating;
use App\Application;

use App\Http\Requests;
use App\Http\Requests\EmployerRequest;

class CompanyProfController extends Controller
{

    public function __construct()
    {
        $this->middleware('employer', ['except' => ['profile', 'companyReview']]);
    }



    public function profile(Request $request, $id, $business_name)
    {
        $company = Employer::findEmployer($id, $business_name)->first();

        $ratings = $company->ownRating->count();

        $ratingSum = $company->ownRating->sum('rating');

        $user = $request->user();

        $authorize = false;

        $rated = false;



        if($ratings === 0)
        {
            $average = 0;

        }else{

            $average = $company->ownRating->avg('rating');
        }


        if($user)
        {   
            $jobSeeker = $user->jobSeeker;

            if($jobSeeker)
            {
                $haveRating = Employer_Rating::where('employer_id', $id)->where('job_seeker_id', $jobSeeker->id)->first();

                if($haveRating === null){

                    $rated = false;

                }else{

                    if($haveRating->job_seeker_id === $jobSeeker->id)
                    {
                        $rated = true;
                    } 
                }    
            }


            $thisEmployer = $user->employer;

            if($thisEmployer){

                if ($company->id === $thisEmployer->id)
                {
                    $authorize = true;
                }
            }
        }

        return view('profiles.company.company', compact('company', 'authorize', 'rated', 'average', 'ratingSum'));
    }



    public function edit(Request $request)
    {
        $employer = $request->user()->employer()->first();

        return view('profiles.company.company_edit', compact('employer'));
    }



    public function store(EmployerRequest $request)
    {
        $user = $request->user();

        $employer = $user->employer()->first();

        $employer->update([

                'business_name' => $request->business_name,
                'business_category' => $request->business_category,
                'business_contact' => $request->business_contact,
                'business_website' => $request->business_website,
                'location' => $request->location,
                'street' => $request->street,
                'city' => $request->city,
                'zip' => $request->zip,
                'state' => $request->state,
                'company_intro' => $request->company_intro,
        ]);

        $employer->save();

        flash('Your profile has been updated', 'success');

        return redirect()->route('company', [$employer->id,$employer->business_name]);
    }



    public function logo(Request $request)
    {
        $employer = $request->user()->employer;

        return view('profiles.company.logo', compact('employer'));
    }



    protected function uploadLogo(Request $request)
    {
        $this->validate($request, [

            'photo' => 'required|mimes:jpg,jpeg,png,bmp' // validate image

        ]);

    	$employer = $request->user()->employer()->first();

    	$file = $request->file('photo');

    	$name = time() . '-' .$file->getClientOriginalName();

    	$file->move('profile_images', $name);

    	$employer->update([

				'business_logo' => "/profile_images/{$name}"
    	]);

    	$employer->save();
    }



    public function rate(Request $request, $id, $user_id)
    {
        $user = $request->user();

        $this->validate($request, [

        'star' => 'required',
        'comment' => 'required|max:255',

        ]);

        $employer = $user->employer;

        $rating = new Job_Seeker_Rating;

        $rating->rating = $request->star;

        $rating->comment = $request->comment;

        $rating->postedBy = $user->name;

        $rating->jobSeeker()->associate($id);

        $rating->employer()->associate($employer->id);

        $rating->save();

        return redirect()->back();
    }


    public function companyReview($id, $business_name)
    {
        $company = Employer::findEmployer($id, $business_name)->first();

        $userReviews = $company->ownRating()->paginate(5);

        return view('profiles.company.company_reviews', compact('company', 'userReviews'));
    }



    public function myAdvert(Request $request)
    {
        $employerID = $request->user()->employer->id;

        $myAdverts = Advert::where('employer_id', $employerID)->get();

        return view('profiles.company.company_adverts', compact('myAdverts'));
    }



    public function jobRequest($id)
    {
        $requests = Application::where('advert_id', $id)->get();

        return view('profiles.company.company_requests', compact('requests'));
    }
}
