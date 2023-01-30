<?php

namespace App\Http\Controllers;

use App\Http\Models\Seo;
use App\Http\Requests\SeoStoreRequest;

class SeoController extends Controller {

    public function seo() {
        $data['seo'] = Seo::seo();
        return view('admin.seo', $data);
    }

    public function fetch_seo($shortcode) {
        echo Seo::fetch_seo($shortcode);
    }

    public function update_seo(SeoStoreRequest $request) {
        Seo::update_seo($request->validated());
    }

}
