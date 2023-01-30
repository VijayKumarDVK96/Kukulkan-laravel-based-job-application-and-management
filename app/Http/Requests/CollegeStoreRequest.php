<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollegeStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'graduation_type_id' => 'required',
            'graduation_degree_id' => 'required',
            'graduation_major_id' => 'required',
            'college_name' => 'required|min:5',
            'total_marks_id' => 'required',
            'passed_out_year' => 'required',
        ];
    }

    public function messages() {
        return [
            'graduation_type_id.required' => 'Graduation is required',
            'graduation_degree_id.required' => 'Degree is required',
            'graduation_major_id.required' => 'Course is required',
            'college_name.required' => 'College Name is required',
            'college_name.min' => 'College Name should be minimum 5 letters',
            'total_marks_id.required' => 'College Total Marks is required',
            'passed_out_year.required' => 'College Passed Out Year is required',
        ];
    }
}
