<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    public $timestamps = false;

    protected $fillable = ['value'];

    public static function configuration() {
        return Setting::all();
    }

    public static function fetch_config($shortcode) {
        return Setting::where('shortcode', $shortcode)->first();
    }

    public static function update_config($data) {
        return Setting::where('shortcode', $data['shortcode'])->update($data);
    }

}
