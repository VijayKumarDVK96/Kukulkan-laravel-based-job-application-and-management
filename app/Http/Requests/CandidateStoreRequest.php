<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name' => 'required|min:5',
            'mobile' => 'required|digits:10',
            'email' => 'required|min:5|email|unique:candidates,email',
            'desired_department' => 'required',
            'desired_position' => 'required',
            'desired_state' => 'required',
            'desired_city' => 'required',
            'experience' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'dob' => 'required|date',
            'pin' => 'required|digits:6',
            'working' => 'required_if:experience,experienced',
            'last_company' => 'required_if:experience,experienced',
            'years_of_experience' => 'required_if:experience,experienced|numeric',
            'current_salary_range' => 'required_if:experience,experienced',
            'expected_salary_range' => 'required_if:experience,experienced',
            'notice_period' => 'required_if:experience,experienced',
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
            'email.unique' => 'This email id is already registered',
            'dob.date' => 'DOB is invalid format',
            'pin.required' => 'PIN code is required',
            'working.required_if' => 'Choose currently working or not',
            'last_company.required_if' => 'Last Company is required',
            'years_of_experience.required_if' => 'Years of experience is required',
            'years_of_experience.numeric' => 'Years of experience is should be number',
            'current_salary_range.required_if' => 'Current Salary is required',
            'expected_salary_range.required_if' => 'Expected Salary is required',
            'notice_period.required_if' => 'Notice Period is required',
        ];
    }
}
