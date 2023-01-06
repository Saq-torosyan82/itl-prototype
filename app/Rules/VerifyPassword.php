<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VerifyPassword implements Rule
{
    private $specialLetter;
    private $capitalLetter;
    private $digit;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->specialLetter = '!$#%';
        $this->capitalLetter = 'A-Z';
        $this->digit = '0-9';
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
        $pattern = "/^(?=.*[a-zA-Z])(?=.*[{$this->digit}])(?=.*[{$this->capitalLetter}])(?=.*[{$this->specialLetter}]).*$/";
        $res = preg_match($pattern, $value);
        return $res;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'PASSWORD must contain: a number, a capital letter, 1 special character as !$#%';
    }
}
