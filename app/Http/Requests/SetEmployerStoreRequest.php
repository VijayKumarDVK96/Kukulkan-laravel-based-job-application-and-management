<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetEmployerStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name' => 'required|min:5',
            'mobile' => 'required|digits:10',
            'email' => 'required|min:5|email|unique:employers,email',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name should be minimum of 5 letters',
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'email.min' => 'Email should be minimum of 5 characters',
            'email.email' => 'Invalid Email',
        ];
    }
}
