<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Driver\AbstractDB2Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if (Auth::user()->hasRole('company')) {
            $image = $profile->image;
            $readOnly = $user->invited_by ? 'disabled=true' : '';
            if (!empty($user->invited_by)) {
                $profile = UserProfile::where('user_id', $user->invited_by)->first();
                $profile->image = $image;
                $profile->user_id = $user->id;
            }
            return view('profile-company')
                ->with('user', $user)
                ->with('profile', $profile)
                ->with('readOnly', $readOnly)
                ->with('provinces', getProvinces())
                ->with('countries', getCountries())
                ->with('counties', getCounties());
        }
        return view('profile')
            ->with('profile', $profile)
            ->with('provinces', getProvinces())
            ->with('countries', getCountries())
            ->with('counties', getCounties());
    }

    public function ProfileInf(){
        $profileInf = UserProfile::where('user_id', Auth::user()->id)->first();
        $profile = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('profile-preview')
            ->with('profileInf',$profileInf)
            ->with('profile', $profile)
            ->with('provinces', getProvinces())
            ->with('countries', getCountries())
            ->with('counties', getCounties());
    }

    public function updateCompanyProfile(Request $request) {
        $user = Auth::user();
        $userId = $user->id;
        if (empty($user->invited_by)) {
            $validation = [
                'company' => 'required|string|max:255',
                'vat' => 'required|string|max:255',
                'company_description' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'contact_phone' => 'required|string|max:255',
                'address' => 'string|max:255',
                'city' => 'required|string|max:255',
                'county' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'country' =>  'required|string|max:255',
                'postal_code' => 'required|string|max:100',
            ];
            $validated = $request->validate($validation);
            $profileFields = [
                'company' => $validated['company'],
                'vat' => $validated['vat'],
                'company_description' => $validated['company_description'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'county' => $validated['county'],
                'province' => $validated['province'],
                'country' =>  $validated['country'],
                'postal_code' => $validated['postal_code'],
                'phone' => $validated['contact_phone'],
            ];
            UserProfile::where('user_id', $userId)->update($profileFields);
        } else {
            $validation = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
            ];
            $validated = $request->validate($validation);
        }

        $userFields = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
        ];
        User::where('id', $userId)->update($userFields);
        return redirect(route('profile'))->with('status', 'Profiled Updated!');
    }

    public function updatepw(Request $request)
    {
        $specialLetter = '!$#%';
        $capitalLetter = 'A-Z';
        $digit = '0-9';
        $request->validate([
            'password' => "required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[{$digit}])(?=.*[{$capitalLetter}])(?=.*[{$specialLetter}]).*$/|confirmed",
        ]);

        User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->password)]);

        return redirect(route('profile'))->with('status', 'Password Updated!');
    }
    public function update(Request $request)
    {
        $validation = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'secondary_email' => 'email',
            'postal_code' => 'string|max:100',
            'phone' => 'string',
        ];
        $update_user = false;
        $update_profile = false;

        if (Auth::user()->hasRole('applicant'))
        {
            $validation = array_merge($validation, [
                'pps' => 'required',
                'secondary_phone'=>'max:30',
                'emergency_name'=>'max:25',
                'emergency_phone'=>'max:30',
                'emergency_relationship'=>'max:50',
            ]);
            $update_user = $request->only(['first_name', 'last_name','avatar']);

            $update_profile = $request->only([
                'secondary_email', 'address', 'city', 'county',
                'postal_code', 'phone', 'pps', 'seeking_employment',
                'own_transport', 'driving_license', 'country', 'province','secondary_phone',
                'emergency_name','secondary_phone','emergency_relationship','emergency_phone',
                'certificate','secondary_address'

            ]);
        } else if (Auth::user()->hasRole('employer'))  {
            $validation = array_merge($validation, [
                'vat' => 'required',
                'company_description' => 'required|string'
            ]);

            $update_user = $request->only(['first_name', 'last_name','avatar']);
            $update_profile = $request->only([
                'secondary_email', 'address', 'city', 'county',
                'postal_code', 'phone', 'vat', 'company_description'
            ]);
        }
        $request->validate($validation);
        //Update User Table
        User::where('id', Auth::user()->id)->update($update_user);
        //Update User Profile
        UserProfile::where('user_id', Auth::user()->id)->update($update_profile);

        return redirect(route('profile'))->with('status', 'Profiled Updated!');

    }

    public function savePicture(Request $request) {
        $request->validate([
            'photo' => 'mimes:jpeg,jpg|required|max:10000' // max 10000kb
        ]);

        if ($request->hasFile('photo')) {
            $userId = $request->id;
            $photo = $request->file('photo');
            $originalExtension =$photo->getClientOriginalExtension();
            $fileName = "avatar-{$userId}.{$originalExtension}";
            UserProfile::where('user_id', $userId)->update(['image' => $fileName]);
            User::where('id', $userId)->update(['avatar' => $fileName]);
            $request->file('photo')->move(public_path('assets/images/users'), $fileName);
            return "assets/images/users/$fileName";
        }
        return false;
    }

    public function saveLogo(Request $request) {

        $request->validate([
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000' // max 10000kb

        ]);
        if ($request->hasFile('photo')) {
            $userId = $request->id;
            $photo = $request->file('photo');
            $originalExtension =$photo->getClientOriginalExtension();
            $fileName = "logo-{$userId}.{$originalExtension}";
            UserProfile::where('user_id', $userId)->update(['image' => $fileName]);
            User::where('id', $userId)->update(['avatar' => $fileName]);
            $request->file('photo')->move(public_path('assets/images/companies'), $fileName);
            return "assets/images/companies/$fileName";
        }
        return false;
    }
}
