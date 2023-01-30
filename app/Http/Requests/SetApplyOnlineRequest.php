<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetApplyOnlineRequest extends FormRequest {

    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:apply_online_reports,email',
            'mobile' => 'required',
            'qualification' => 'required',
            'broadband' => 'nullable',
            'address' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'experience' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid Email',
            'address.required' => 'Address is required',
            'state_id.required' => 'State is required',
            'city_id.required' => 'City is required',
        ];
    }
}
