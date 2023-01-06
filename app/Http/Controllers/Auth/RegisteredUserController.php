<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CompanyCreationPostRequest;
use App\Mail\CandidateCreated;
use App\Models\User;
use App\Models\UserProfile;
use App\Providers\RouteServiceProvider;
use App\Rules\Captcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    public function createCompany() {
        return view ('auth.register-company');
    }

    public function createEmpByInvitationFromCompany($hash) {
        $user = User::where('invitation_token', $hash)->first();
        $userProfile = $user->profile;
        return view ('auth.register-by-invitation', ['userProfile' => $userProfile, 'userId' => $user->id]);
    }
    public function createInvitedClient(CompanyCreationPostRequest $request) {
        if ($request->step == 1) {
            $validated = $request->validated();
            $request->session()->put('company_name', $validated['company_name']);
            $request->session()->put('company_phone', $validated['company_phone']);
            $request->session()->put('email', $validated['email']);
            $request->session()->put('password', $validated['password']);
            $request->session()->put('invitedId', $request->invitedId);
            return view ('auth.register-by-invitation-next');
        } else {
            $validated = $request->validated();
            $companyName = $request->session()->get('company_name');
            $companyPhone = $request->session()->get('company_phone');
            $email = $request->session()->get('email');
            $password = $request->session()->get('password');
            $firstName = $validated['first_name'];
            $lastName =  $validated['last_name'];
            $personPhone = $validated['person_phone'];
            $invitedId = $request->session()->get('invitedId');
            $userProfile = UserProfile::getProfileByUserId($invitedId);
            //dd($userProfile);
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => Hash::make($password),
                'phone' => $personPhone,
                'invited_by' => $invitedId
            ]);
            UserProfile::create([
                'user_id' => $user->id,
                'address' => $userProfile->address,
                'city' => $userProfile->city,
                'postal_code' => $userProfile->postal_code,
                'county' => $userProfile->county,
                'province' => $userProfile->province,
                'country' => $userProfile->country,
                'vat' => $userProfile->vat,
                'phone' => $companyPhone,
                'company' => $companyName
            ]);
            $user->assignRole('company');
            Auth::login($user);
            event(new Registered($user));
            return redirect(RouteServiceProvider::HOME);
            //dump([$companyName, $companyPhone, $email, $password, $firstName, $lastName, $personPhone]);
        }
    }


    public function createCompanyFirst(CompanyCreationPostRequest $request) {
        if ($request->step == 1) {
            $validated = $request->validated();
            $request->session()->put('company_name', $validated['company_name']);
            $request->session()->put('company_phone', $validated['company_phone']);
            $request->session()->put('email', $validated['email']);
            $request->session()->put('password', $validated['password']);
            return view ('auth.register-company-next');
        } else {
            $validated = $request->validated();
            $companyName = $request->session()->get('company_name');
            $companyPhone = $request->session()->get('company_phone');
            $email = $request->session()->get('email');
            $password = $request->session()->get('password');
            $firstName = $validated['first_name'];
            $lastName =  $validated['last_name'];
            $personPhone = $validated['person_phone'];
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => Hash::make($password),
                'phone' => $personPhone
            ]);
            UserProfile::create([
                'user_id' => $user->id,
                'address' => "",
                "city" => "",
                "postal_code" => "",
                "county" => null,
                'phone' => $companyPhone,
                'company' => $companyName
            ]);
            $user->assignRole('company');
            Auth::login($user);
            event(new Registered($user));
            return redirect(RouteServiceProvider::HOME);
            //dump([$companyName, $companyPhone, $email, $password, $firstName, $lastName, $personPhone]);
        }
    }

    public function createEmp()
    {
        return view ('auth.register-employer');
    }
    public function createCandidate()
    {
        return view ('auth.register-candidate');
    }
    public function createCandidateFirst(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'g-recaptcha-response' => [new Captcha],
        ]);
        $email = $request->email;
        $password = $request->password;
        $request->session()->put('email', $email);
        $request->session()->put('password', $password);
        return view ('auth.register-candidate-next')->with('phone_codes', getCountryCodes());;
    }

    public function createCandidateSecond(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'agree_terms' => 'accepted'
        ]);
        $email = $request->session()->get('email');
        $password = $request->session()->get('password');
        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $phone = !empty($request->phone_code) ? "{$request->phone_code}-{$request->phone}" : $request->phone;
        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        UserProfile::create([
            'user_id' => $user->id,
            'address' => "",
            "city" => "",
            "postal_code" => "",
            "county" => null,
            'phone' => $phone,
            'company' => null
        ]);
        $user->assignRole('agency');
        Auth::login($user);
        event(new Registered($user));
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        //dd($request);
        switch($request->registration_type)
        {
            case "applicant":
                $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                    'agree' =>'accepted',
                    'g-recaptcha-response' => [new Captcha],
                ]);

                Auth::login($user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
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

                $user->assignRole('applicant');
                break;

            case "employer":
                $request->validate([
                    'company' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                    'agree' =>'accepted',
                    'g-recaptcha-response' => [new Captcha],
                ]);

                Auth::login($user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]));

                UserProfile::create([
                    'user_id' => $user->id,
                    'address' => "",
                    "city" => "",
                    "postal_code" => "",
                    "county" => null,
                    "company" => $request->company,
                    'phone' => ""
                ]);

                $user->assignRole('employer');
                break;

            default:
                throw new \Exception('RegisteredUserController : Missing Switch Statement');

        }


        event(new Registered($user));
        return redirect(RouteServiceProvider::HOME);
    }
}
