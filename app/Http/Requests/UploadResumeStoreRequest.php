<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadResumeStoreRequest extends FormRequest {

    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'resume' => 'required|mimes:pdf,doc,docx|max:3072',
        ];
    }

    public function messages() {
        return [
            'resume.required' => 'Upload Resume',
            'resume.mimes' => 'Only pdf,doc,docx formats supported',
            'resume.max' => 'Maximum file size is 3 MB',
        ];
    }
}
