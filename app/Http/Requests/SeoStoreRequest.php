<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoStoreRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'title' => 'required',
            'shortcode' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Title is required',
            'shortcode.required' => 'Shortcode is required',
            'description.required' => 'Description is required',
            'keywords.required' => 'Keywords is required',
        ];
    }
}
