<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Mail;
use Image;
use Event;
use Cache;
use Services_Twilio;
use \Braintree_Customer;

use Carbon\Carbon;

use App\User;
use App\Advert;
use App\Application;

use App\Contracts\Search;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['terms', 'calculator']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        // get authorized user's data
        $user = $request->user();

        $ftu_level = $user->ftu_level;

        // get user's type of role
        $userType = $user->type;

        // get user's avatar
        $avatar = $user->avatar;

        // check if user's avatar exist & get the provided avatar
        $avatar = $user->currentAvatar();

        // check user's acc type
        if($user->hasRole('employer'))
        {
            // get user's profile related info
            $role = $user->employer;
            $applications = $role->applications->where('status', 'PENDING');
            $requestTotal = count($applications);
            $adverts = $role->adverts->where('about_to_expire', 1);
            $level3Adverts = $role->adverts->where('advert_level', 3);

            switch ($requestTotal)
            {
                case ($requestTotal > 0):
                    $informations = $applications;
                    //$message = "You have a request from";
                    $text = "View";
                    break;
                default:
                    $informations = null;
                    //$message = "";
                    $text = "";
            }

            switch ($ftu_level)
            {
                case 1:
                    $message1 = "You have not yet created your first advert.";
                    $text1 = "Continue";
                    $link = '/adverts/create';
                    break;
                case 2:
                    $advert = $role->adverts->first();
                    $advertID = $advert->id;
                    $advertJobTitle = $advert->job_title;
                    if($advert->ready_to_publish != 0)
                    {
                        $message1 = "You have not yet publish your advert.";
                        $text1 = "Continue";
                        $link = '/choose/plan/'.$advertID;
                    }else{
                        $message1 = "You have not yet complete filling up your advert form.";
                        $text1 = "Continue";
                        $link = '/adverts/'.$advertID.'/'.$advertJobTitle.'/edit';
                    }
                    break;
                case 3:
                    $advert = $role->adverts->first();
                    $advertID = $advert->id;
                    $advertJobTitle = $advert->job_title;
                    $message1 = "You have not complete your checkout for your advert";
                    $text1 = "Continue";
                    $link = '/checkout/'.$advertID;
                    break;
                case 4:
                    $advert = $role->adverts->first();
                    $advertID = $advert->id;
                    $advertJobTitle = $advert->job_title;
                    $message1 = "You have not yet publish your advert!";
                    $text1 = "Continue";
                    $link = '/adverts/'.$advertID.'/'.$advertJobTitle;
                    break;
                default:
                    $message1 = "";
                    $text1 = "";
                    $link = "";
            }

        }elseif($user->hasRole('job_seeker')){

            // get user's profile related info
            $role = $user->jobSeeker;
            $responses = $role->applications->where('responded', 1)->where('viewed', 0);
            $responseTotal = count($responses);
            
            switch ($responseTotal)
            {
                case ($responseTotal > 0):
                    $informations = $responses;
                    $message = "You have a response from your request for";
                    break;
                default:
                    $informations = null;
                    $message = "";
            }

            switch ($ftu_level)
            {
                case 1:
                    $message1 = "You have not yet select your preferred job category.";
                    $text1 = "Continue";
                    $link = '/preferred-category';
                    break;
                default:
                    $message1 = "";
                    $text1 = "";
                    $link = "";
            }

        }elseif($user->hasRole('admin')){

            return redirect('/a/dashboard');

        }

        // return user to home dashboard
        return view('dashboard', compact('user', 'avatar', 'informations', 'message', 'message1', 'text', 'text1', 'link', 'site', 'adverts', 'level3Adverts'));
    }


    /**
     * Show the upload avatar page.
     *
     */
    public function avatar(Request $request)
    {
        $user = $request->user();
        $photo = $user->currentAvatar();

        if($photo != "/images/defaults/default.jpg")
        {
            $fileExist = true;
        }else{
            $fileExist = false;
        }

        return view('auth.account.avatar', compact('user','photo','fileExist'));
    }


    /**
     * Store the uploaded avatar image.
     *
     */
    protected function uploadAvatar(Request $request, Search $search)
    {   
        // store user's info in variable
        $user = $request->user();

        // validation function
        $this->validate($request, [

            // allow only this type of image
            'photo' => 'required|mimes:jpg,jpeg,png,bmp' 
        ]);

        // store the uploaded file in a variable and fetch by paramName
        $file = $request->file('photo');

        // set the timestamp to the file name
        $name = time(). '-' .$file->getClientOriginalName();

        // provide a path
        $path = "images/profile_images/avatars";

        // provide path URl for Database
        $pathURL = "/".$path."/".$name;

        // use intervention facade to resize image then move/upload to dir
        Image::make($file)->fit(200, 200)->save($path."/".$name);

        // update user's file path url then save to database
        $user->update([ 'avatar' => $pathURL ]);

        $user->save();
    }


    /**
     * remove the uploaded avatar image.
     *
     */
    public function remove(Request $request, Search $search)
    {
        $user = $request->user();

        $user->avatar = "/images/defaults/default.jpg";
        
        $user->save();

        // flash message
        flash('Your photo has been successfully removed', 'success');

        return redirect()->back();
    }



    public function terms()
    {
        return view('pages.terms');
    }



    public function contact(Request $request)
    {
        $user = $request->user();
        $verified = $user->contact_verified;
        $contact = $user->contact;

        if($verified === 1)
        {
            return redirect('/dashboard');
        }

        return view('auth.verifications.contact_verification', compact('contact'));
    }



    public function updateContact(Request $request)
    {
        $user = $request->user();

        if($user->contact != $request->contact)
        {
            $user->contact_verified = 0;
            $user->contact_verification_code = null;
        }
        
        $user->contact = $request->contact;
        $user->save();
    }



    public function sendContactToken(Request $request)
    {
        $contactCode = mt_rand(11111,99999);

        $user = $request->user();
        $user->contact_verification_code = $contactCode;
        $user->save();

        $contact = $user->contact;

        $config = config('services.twilio');

            // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
            $AccountSid = $config['acc_id'];
            $AuthToken = $config['auth_token'];

                // Step 3: instantiate a new Twilio Rest Client
                $client = new Services_Twilio($AccountSid, $AuthToken);

                // Step 4: make an array of people we know, to send them a message. 
                // Feel free to change/add your own phone number and name here.
                $people = array(
                    //"+60176613069" => $user->name,
                    "+6".$contact => $user->contact,
                    //"+14158675310" => "Boots",
                    //"+14158675311" => "Virgil",
                );
                
                // Step 5: Loop over all our friends. $number is a phone number above, and 
                // $name is the name next to it
                foreach ($people as $number => $name) {

                    $sms = $client->account->messages->sendMessage(

                        // Step 6: Change the 'From' number below to be a valid Twilio number 
                        // that you've purchased, or the (deprecated) Sandbox number
                        "+12602184571", 

                        // the number we are sending to - Any phone number
                        $number,

                        // the sms body
                        "This is your verification code for WorkWork: $contactCode"
                    );
                    // Display a confirmation message on the screen
                    //echo "Sent message to $name";
                }
    }



    public function verifyContact(Request $request)
    {
        $this->validate($request, [
                'code' => 'required|min:5|max:5',
            ]);

        $code = $request->code;
        $user = $request->user();
        $userCode = $user->contact_verification_code;

        if($code === $userCode)
        {
            $user->contact_verified = 1;
            $user->contact_verification_code = null;
            $user->save();

            flash('Your contact has been verified','success');

            return redirect('/dashboard');
        }

        flash('Your code did not match!','error');
        return redirect()->back();  
    }



    public function account(Request $request)
    {
        $user = $request->user();
        return view('auth.account.account', compact('user'));
    }



    public function accountEdit(Request $request)
    {
        $user = $request->user();
        return view('auth.account.account_edit', compact('user'));
    }



    public function accountUpdate(Request $request)
    {   
        $user = $request->user();

        $this->validate($request, [
                'name' => 'required|max:50',
            ]);

        if($user->contact != $request->contact)
        {
            $user->contact_verified = 0;
        }

        if($user->email != $request->email)
        {
            $this->validate($request, [
                'email' => 'required|email|unique:users',
            ]);
            $user->verified = 0;

        }else{

            $this->validate($request, [
                'email' => 'required|email',
            ]);
        }

        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'contact' => $request->contact,
        ]);

        $user->save();

        $customerID = $user->braintree_id;
        if($customerID){
            $result = Braintree_Customer::update($customerID, 
                [
                    'firstName' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->contact,
                ]
            );
        }

        if($user->verified == 0)
        {
            flash('a verification email has been sent to your new added email. Please verify before logging back in', 'info');

            return redirect('/request/verification');
        }

        flash('Your account detail has been updated', 'success');

        return redirect('account');
    }

    public function requestToken(Request $request)
    {
        $user = $request->user();

        return view('auth.verifications.request_token', compact('user'));
    }

    public function sendRequestedToken(Request $request)
    {
        // generate a random string
        $verification_code = str_random(30);

        // find the user with the given email
        $user = $request->user();

        // store the generated token/verification code to the selected user
        $user->verification_code = $verification_code;
        $user->save();

        // fetch mailgun attributes from SERVICES file
        $config = config('services.mailgun');

        // applications domain
        $domain = $config['sender'];

        // fetch website provided url
        $website = $config['site_url'];

        // set the values in array
        $data = ['website' => $website, 'verification_code' => $verification_code];
        $parameter = ['user' => $user, 'domain' => $domain];

        // use send method form Mail facade to send email. ex: send('view', 'info / array of data', fucntion)
        Mail::send('auth.emails.verify_email', compact('website','verification_code'), function ($message) use ($parameter) {

            // Recipient Test Email => $recipient = "farid@pocketpixel.com";

            // get the necessary required values for mailgun
            $appDomain = $parameter['domain'];
            $recipient = $parameter['user']->email;
            $recipientName = $parameter['user']->name;

            // set email sender stmp url and sender name
            $message->from($appDomain, 'WorkWork');

            // set email recepient and subject
            $message->to($recipient, $recipientName)->subject('Welcome to WorkWork!');
        });

        flash('a verification email has been sent to your email address. Please check your inbox for further instruction', 'info');

        return redirect('/dashboard');
    }

    protected function unauthorized(Request $request)
    {
        if($request->ajax())
        {
            return response(['message' => 'No!'], 403);
        }

        abort(403, 'Unauthorized action.');
    }
}
