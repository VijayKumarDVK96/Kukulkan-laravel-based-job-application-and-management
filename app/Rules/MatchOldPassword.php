<?php

namespace App\Rules;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class MatchOldPassword implements Rule {
    
    public function passes($attribute, $value) {
        return Hash::check($value, auth()->user()->password);
    }
    
    public function message() {
        return 'Old Password is incorrect';
    }
}
