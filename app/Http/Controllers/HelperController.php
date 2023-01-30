<?php

namespace App\Http\Controllers;
use DB;

class HelperController extends Controller {

    public $experience = ["Fresher", "Experienced"];
    public $gender = ["Male", "Female"];
    public $status = [1 => "Pending", 2 => "Completed"];

    function job_department() {
        return DB::table('job_department')->orderBy('name', 'ASC')->get();
    }

    function job_position() {
        return DB::table('job_position')->orderBy('name', 'ASC')->get();
    }

    function job_type() {
        return DB::table('job_type')->get();
    }

    function states() {
        return DB::table('states')->get();
    }

    function cities($state_id) {
        return DB::table('cities')->where('state_id', $state_id)->get();
    }

    function show_cities($state_id) {
        $cities = $this->cities($state_id);
        
        $city = '<option value="">Select City</option>';
        foreach($cities as $value) {
            $city .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }

        echo $city;
    }

    function salary_range() {
        return DB::table('salary_range')->get();
    }

    function notice_period() {
        return DB::table('notice_period')->get();
    }

    function school_class() {
        return DB::table('school_class')->get();
    }

    function school_board() {
        return DB::table('school_board')->get();
    }

    function school_medium() {
        return DB::table('school_medium')->get();
    }

    function total_marks() {
        return DB::table('total_marks')->get();
    }

    function graduation_degree() {
        return DB::table('graduation_degree')->orderBy('name', 'ASC')->get();
    }

    function graduation_type() {
        return DB::table('graduation_type')->orderBy('name', 'ASC')->get();
    }

    function graduation_major() {
        return DB::table('graduation_major')->orderBy('name', 'ASC')->get();
    }


    function year() {
        $current_year = date('Y');
        $from_year = $current_year - 50;
        return range($current_year, $from_year);
    }

}
