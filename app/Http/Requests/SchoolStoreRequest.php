<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'school_class_id' => 'required',
            'school_board_id' => 'required',
            'school_medium_id' => 'required',
            'school_name' => 'required|min:5',
            'total_marks_id' => 'required',
            'passed_out_year' => 'required',
        ];
    }

    public function messages() {
        return [
            'school_class_id.required' => 'School Class is required',
            'school_board_id.required' => 'School Board is required',
            'school_medium_id.required' => 'School Medium is required',
            'school_name.required' => 'School Name is required',
            'school_name.min' => 'School Name should be minimum 5 letters',
            'total_marks_id.required' => 'School Total Marks is required',
            'passed_out_year.required' => 'School Passed Out Year is required',
        ];
    }
}
