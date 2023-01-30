<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ImportedCandidates extends Model {

    public $timestamps = false;

    protected $fillable = ['full_name', 'designation', 'last_company', 'education', 'location', 'mobile', 'email', 'experience', 'gender', 'age', 'salary', 'source', 'remarks', 'created_at'];

    public function getFillable() {
        return $this->fillable;
    }

    // Accessor
    public function getCreatedAtAttribute($value) {
        return date('d-m-Y h:i:s A', strtotime($value));
    }

    public static function get_imported_candidates() {
        return ImportedCandidates::orderBy('created_at', 'desc')->get();
    }

    public static function fetch_imported_candidates($email, $mobile) {
        return ImportedCandidates::where('email', $email)->orWhere('mobile', $mobile)->get();
    }

    public static function delete_imported_candidates($select) {
        return ImportedCandidates::whereIn('id', $select)->delete();
    }

    public static function fetch_imported_candidate($id) {
        return ImportedCandidates::find($id);
    }

    public static function update_imported_candidate($id, $data) {
        return ImportedCandidates::where('id', $id)->update($data);
    }
}
