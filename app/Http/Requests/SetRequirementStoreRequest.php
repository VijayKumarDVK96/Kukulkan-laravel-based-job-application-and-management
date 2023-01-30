<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetRequirementStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'company_name' => 'required',
            'company_address' => 'required',
            'company_website' => 'nullable',
            'desired_department_id' => 'required',
            'desired_position_id' => 'required',
            'desired_state_id' => 'required',
            'desired_city_id' => 'required',
            'desired_age_from' => 'required',
            'desired_age_to' => 'required',
            'desired_gender' => 'required',
            'total_candidates' => 'required|numeric',
            'job_title' => 'required',
            'job_experience' => 'required',
            'job_description' => 'required',
            'job_salary_range_id' => 'required',
            'job_work_type_id' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required|digits:10',
            'contact_person_position_id' => 'required',
        ];
    }

    public function messages() {
        return [
            "company_name.required" => "Company Name is required",
            "company_address.required" => "Company Address is required",
            "desired_department_id.required" => "Job Vacant Sector is required",
            "desired_position_id.required" => "Job Vacant Title is required",
            "desired_state_id.required" => "State is required",
            "desired_city_id.required" => "City is required",
            "job_work_type_id.required" => "Job Type is required",
            "job_salary_range_id.required" => "Salary Range is required",
            "contact_person_name.required" => "Contact Person Name is required",
            "contact_person_mobile.required" => "Contact Person Mobile is required",
            "contact_person_position_id.required" => "Contact Person Job Title is required",
        ];
    }
}
