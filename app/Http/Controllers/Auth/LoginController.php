<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Helpers\UserSystemInfoHelper;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Browser;
use Mail;


class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/';

    protected function redirectTo() {

        // this generate a mail and send it to the user's email address
//        $userIP = '102.88.35.208';
//        $location = Location::get($userIP);
//        $countryName = $location->countryName;
//        $cityName = $location->cityName;
//        $date = Carbon::now()->toDateTimeString();
//        $getos = Browser::platformName();
//        $getbrowser = Browser::browserFamily();
//        $user_email = Auth::user()->email;
//        $first_name = Auth::user()->first_name;
//
//        // this will get the device type and give it a custom name
//        if (Browser::isDesktop()) {
//            $getdevice = 'Desktop computer';
//        } else if (Browser::isMobile()) {
//            $getdevice = 'Mobile';
//        } else if (Browser::isTablet()) {
//            $getdevice = 'Tablet';
//        }
//
//        if (Browser::deviceModel()) {
//            $device_name = Browser::deviceModel();
//        } else {
//            $device_name = 'Unknown Device';
//        }
//        
//        // this will send mail to the right mail class in Laravel, then the mail will be sent from the mail class to the email address
//        $email_data = [
//            'subject' => 'Security alert',
//            'name' => $first_name,
//            'user_email' => $user_email,
//            'userIp' => $userIP,
//            'country' => $countryName,
//            'city' => $cityName,
//            'date' => $date,
//            'device_type' => $getdevice,
//            'device_name' => $device_name,
//            'device_os' => $getos,
//            'device_browser' => $getbrowser,
//        ];
//
//        Mail::to($user_email)->send(new \App\Mail\loginMail($email_data));
//
//        // save user activity to database
//        $user_id = Auth::user()->id;
//        $activity = new activity;
//        $activity->user_id = $user_id;
//        $activity->description = "Log in successfull";
//        $activity->save();

        // redirects users to the right homepage for the user
        // if (Auth()->user()->role == 'admin') {
        //     return route('admin.dashboard');
        // } elseif (Auth()->user()->role == 'editor') {
        //     return route('editor.dashboard');
        // } elseif (Auth()->user()->role == 'user') {
        //     return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
        // }
    }
    
    public function showLoginForm(Request $request){
     
        return view('auth.login');
    }

        public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:3|max:100',
        ],
    [
        'email.required' => 'The email address field cannot be empty'
    ]);
        
        $user = User::where('email', $request->email)->first();
         
        if($user){
        if(Hash::check($request->password, $user->password)){
            Auth::attempt($request->only('email', 'password'));
            return response()->json([
                'code' => 200,
                'message' => 'login successful',
                'user' => $user->role
            ]);
        }
        else{
            return response()->json([
                'code' => 401,
                'message' => 'Incorrect login details'
            ]);
        }
            
        }
        else{
            return response()->json([
                'code' => 401,
                'message' => 'Account does not exist'
            ]);
        }
//        $credentials = $request->only('email', 'password');
//  
//        if (Auth::attempt($credentials)) {
//  
//        }
//  
//        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        
          
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
        Session::put('backUrl', URL::previous());
    }

}
