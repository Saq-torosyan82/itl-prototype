<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    protected $providers = [
        'facebook','google','linkedin'
    ];

    protected $userTypes = ['applicant', 'employer'];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(Request $request, $driver, $user_type = '')
    {
        if (!empty($user_type)) {
            $request->session()->put('social_register_user_type', $user_type);
        }

        if(!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function handleProviderCallback(Request $request, $driver)
    {
        try {
            $request->session()->put('state', $request->state);
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        $userType = $request->session()->get('social_register_user_type');
        $request->session()->forget('social_register_user_type');

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver, $userType);
    }

    protected function sendSuccessResponse()
    {
        return redirect(RouteServiceProvider::HOME);
    }

    protected function sendFailedResponse($msg = null, $route = '/')
    {
        return redirect()->route($route)
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver, $userType = '')
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        if (!empty($userType)) {
            if ($user) {
                return $this->sendFailedResponse("The email has already been taken.", ($userType == 'applicant' ? 'register' : 'register/employer'));
            }

            $this->createAccount($driver, $providerUser, $userType);
        } else {
            if (!$user) {
                return $this->sendFailedResponse("These credentials do not match our records.", 'login');
            }

            $this->loginAccount($driver, $user, $providerUser);
        }

        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    private function isUserTypeAllowed($type)
    {
        return in_array($type, $this->userTypes);
    }

    private function createAccount($driver, $providerUser, $userType = '')
    {
        if ($this->isUserTypeAllowed($userType)) {
            $userName = explode(' ', $providerUser->getName());

            Auth::login($user = User::create([
                'first_name'   => $userName[0],
                'last_name'    => isset($userName[1]) ? $userName[1] : '',
                'email'        => $providerUser->getEmail(),
                'password'     => '',
                'avatar'       => $providerUser->getAvatar(),
                'provider'     => $driver,
                'provider_id'  => $providerUser->getId(),
                'access_token' => $providerUser->token,
            ]));

            UserProfile::create([
                'user_id' => $user->id,
                'address' => "",
                "city" => "",
                "postal_code" => "",
                "county" => null,
                'phone' => "",
                'company' => null
            ]);

            $user->assignRole($userType);
        } else {
            throw new \Exception('SocialController : Wrong User Type');
        }

        event(new Registered($user));
    }

    private function loginAccount($driver, $user, $providerUser)
    {
        $user->update([
            'avatar'       => $providerUser->getAvatar(),
            'provider'     => $driver,
            'provider_id'  => $providerUser->getId(),
            'access_token' => $providerUser->token
        ]);

        Auth::login($user);
    }
}
