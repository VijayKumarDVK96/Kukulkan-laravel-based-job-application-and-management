<?php

namespace App\Http\Controllers;

use App\Http\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller {

    public function configuration() {
        $data['config'] = Setting::configuration();
        // echo "<pre>";print_r($data['contact_details']);exit;
        return view('admin.configuration', $data);
    }

    public function edit_config($shortcode) {
        echo Setting::fetch_config($shortcode)->toJson();
    }

    public function update_config(Request $request) {
        $data = $request->validate([
            'value' => 'required',
            'shortcode' => 'required',
        ], [
            'value.required' => 'Value is Required',
            'shortcode.required' => 'Shortcode is Required',
        ]);

        Setting::update_config($data);
    }

}
