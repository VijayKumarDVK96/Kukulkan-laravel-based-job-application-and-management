<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model {

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'keywords'];

    public static function seo() {
        return Seo::all();
    }

    public static function fetch_seo($shortcode) {
        return Seo::where('shortcode', $shortcode)->first();
    }

    public static function update_seo($data) {
        return Seo::where('shortcode', $data['shortcode'])->update($data);
    }

}