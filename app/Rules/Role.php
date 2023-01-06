<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class Role implements Rule
{
    private $role;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('email', $value)->first();
        return $user ? $user->hasRole($this->role) : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->role == "applicant" ? "This e-mail is not client's email" : "This e-mail has not valid role";
    }
}
