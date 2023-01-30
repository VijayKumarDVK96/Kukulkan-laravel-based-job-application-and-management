<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Employer extends Model {

    public $timestamps = false;

    /********************/
    /*******CREATE*******/
    /********************/

    public static function create_employer($employer, $requirement) {
        $insert_id = Employer::insertGetId($employer);;

        if(!empty($requirement)) {
            foreach ($requirement as $key => $value) {
                $value['employer_id'] = $insert_id;
                $value['needed_candidates'] = $value['total_candidates'];
                DB::table('requirements')->insert($value);
            }
        }
    }

    /********************/
    /********READ********/
    /********************/

    public static function show_employers($status) {
        return DB::table('employers')
            ->select(DB::raw("employers.id, employers.full_name, employers.email, employers.mobile, job_department.name AS job_department, job_position.name AS job_position"))
            ->leftJoin('job_department', 'employers.job_department', '=', 'job_department.id')
            ->leftJoin('job_position', 'employers.job_position', '=', 'job_position.id')
            ->where(function ($query) use($status) {
                if($status == 1) {
                    $query->where('employers.profile_status', $status);
                } else {
                    $query->whereNull('employers.profile_status');
                }
            })
            ->orderBy('employers.full_name', 'asc')
            ->get();
    }

    public static function fetch_employer($id) {
        return DB::table('employers')
            ->select(DB::raw("employers.full_name, employers.email, employers.mobile, DATE_FORMAT(employers.created_at, '%D %b %Y - %h:%i %p') AS datetime, employers.company_name, employers.company_address, employers.company_website, job_department.name AS job_department, job_position.name AS job_position"))
            ->leftJoin('job_department', 'employers.job_department', '=', 'job_department.id')
            ->leftJoin('job_position', 'employers.job_position', '=', 'job_position.id')
            ->where('employers.id', $id)
            ->first();
    }

    public static function edit_employer($id) {
        return Employer::find($id);
    }

    /********************/
    /*******UPDATE*******/
    /********************/

    public static function update_employer($employer) {
        return Employer::where('id', $employer['id'])->update($employer);
    }

    public static function approve_new_employers($select) {
        return Employer::whereIn('id', $select)->update(['profile_status' => 1]);
    }

    /********************/
    /*******DELETE*******/
    /********************/

    public static function delete_employer($id) {
        Employer::destroy($id);
    }

    public static function delete_new_employers($select) {
        return Employer::whereIn('id', $select)->delete();
    }
}
