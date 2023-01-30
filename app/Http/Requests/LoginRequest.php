<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ];
    }

    public function messages() {
        return [
            "email.required" => "Email is required",
            "email.email" => "Invalid Email",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters",
        ];
    }
}
