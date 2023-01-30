<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class ApplyOnlineReport extends Model {

    public $timestamps = false;

    protected $fillable = ['name', 'gender', 'email', 'mobile', 'qualification', 'experience', 'broadband', 'address', 'state_id', 'city_id', 'created_at'];

    // Accessor
    public function getCreatedAtAttribute($value) {
        return date('d-m-Y h:i A', strtotime($value));
    }

    public static function apply_online_reports($status) {
        return ApplyOnlineReport::select('apply_online_reports.*', 'states.name AS state', 'cities.name AS city')
            ->leftJoin('states', 'apply_online_reports.state_id', '=', 'states.id')
            ->leftJoin('cities', 'apply_online_reports.city_id', '=', 'cities.id')
            ->where('apply_online_reports.status', $status)
            ->latest()->get();
    }

    public static function approve_online_reports($select) {
        return ApplyOnlineReport::whereIn('id', $select)->update(['status' => 1]); 
    }

    public static function delete_online_reports($select) {
        return ApplyOnlineReport::whereIn('id', $select)->delete();
    }

}