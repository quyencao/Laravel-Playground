<?php

namespace App\Http\Controllers\Auth;

use App\Activation;
use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Mail\ActivationEmail;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function userActivation($token) {
        $activation = Activation::where('token', $token)->first();

        if($activation) {
            $user = User::find($activation->id_user);

            $user->update([
                'is_activated' => 1
            ]);

            $activation->delete();

            return redirect()->route('login')->with('success', 'Your account is already activated!');
        }

        return redirect()->route('login')->with('warning', 'Your token is invalid');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
            if(Auth::user()->is_activated != 1) {
                Auth::logout();
                return redirect()->back()->with('warning', 'First please activate your account.');
            }

            return redirect()->route('home');
        }

        return $this->sendFailedLoginResponse($request);

    }

    public function resendForm() {
        return view('email.resendEmail');
    }

    public function resend(Request $request) {
        $this->validate($request, [
           'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {

            $activation = Activation::where('id_user', $user->id)->first();

            if($activation) {
                event(new Registered($user, $activation->token));
            } else {
                $token = str_random(64);

                Activation::create([
                   'id_user' => $user->id,
                   'token' => $token
                ]);

                event(new Registered($user, $token));
            }

            return redirect()->to('login')->with('success', 'New activation email has sent.');
        }

        return redirect()->back()->with('error', 'Email not exist.');
    }
}
