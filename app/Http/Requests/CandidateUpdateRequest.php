<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateRequest extends FormRequest {

    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name' => 'required|min:5',
            'mobile' => 'required|digits:10',
            'email' => 'required|min:5|email',
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
            'school_class.*' => 'required',
            'school_board.*' => 'required',
            'school_medium.*' => 'required',
            'school_name.*' => 'required|min:5',
            'school_total_marks.*' => 'required',
            'school_passed_out_year.*' => 'required',
            'graduation_type.*' => 'required',
            'graduation_degree.*' => 'required',
            'graduation_major.*' => 'required',
            'college_name.*' => 'required|min:5',
            'college_total_marks.*' => 'required',
            'college_passed_out_year.*' => 'required',
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
            'school_class_id.*.required' => 'School Class is required',
            'school_board_id.*.required' => 'School Board is required',
            'school_medium_id.*.required' => 'School Medium is required',
            'school_name.*.required' => 'School Name is required',
            'school_name.*.min' => 'School Name should be minimum 5 letters',
            'school_total_marks.*.required' => 'School Total Marks is required',
            'school_passed_out_year.*.required' => 'School Passed Out Year is required',
            'graduation_type.*.required' => 'Graduation is required',
            'graduation_degree.*.required' => 'Degree is required',
            'graduation_major.*.required' => 'Course is required',
            'college_name.*.required' => 'College Name is required',
            'college_name.*.min' => 'College Name should be minimum 5 letters',
            'college_total_marks.*.required' => 'College Total Marks is required',
            'college_passed_out_year.*.required' => 'College Passed Out Year is required',
        ];
    }
}
