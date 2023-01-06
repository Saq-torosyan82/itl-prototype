<?php

namespace App\Http\Requests\Auth;

use App\Rules\Captcha;
use App\Rules\VerifyPassword;
use Illuminate\Foundation\Http\FormRequest;

class CompanyCreationPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->step == '1') {
            return [
                'company_name' => 'required|string|max:255',
                'company_phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'string', 'min:8', 'confirmed', new VerifyPassword()],
                'password_confirmation' => 'required|string|min:8',
            ];
        } else {
            return [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'person_phone' => 'required|string|max:255',
                'g-recaptcha-response' => [new Captcha],
                'agree_terms' => 'accepted'
            ];
        }

    }
    public function messages()
    {
        return [
            'password.regex' => 'Password must contain: a number, a capital letter, 1 special character as !$#%',
        ];
    }

    public function validated()
    {
        return $this->validator->validated();
    }
}
