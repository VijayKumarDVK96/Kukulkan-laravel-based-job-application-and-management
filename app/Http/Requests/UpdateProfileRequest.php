<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }

    public function rules() {
        $data = explode('/', $_SERVER['REQUEST_URI']);
        return [
            'name' => 'required',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|unique:users,email,'.end($data),
            'password' => 'nullable|min:5,'.end($data),
            'address' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid Email',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'address.required' => 'Address is required',
        ];
    }
}
