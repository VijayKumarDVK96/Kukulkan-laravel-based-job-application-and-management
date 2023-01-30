<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'full_name' => 'required',
            'mobile' => 'required|digits:10',
            'email' => 'required|min:5|email',
            'company_name' => 'required',
            'company_website' => 'nullable',
            'company_address' => 'required',
            'job_department' => 'required',
            'job_position' => 'required',
        ];
    }

    public function messages() {
        return [
            "full_name.required" => "Name is required",
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'email.min' => 'Email should be minimum of 5 characters',
            'email.email' => 'Invalid Email',
            'email.unique' => 'This email id is already registered',
            "company_name.required" => "Company Name is required",
            "job_department.required" => "Job Sector is required",
            "job_position.required" => "Job Title is required",
        ];
    }
}
