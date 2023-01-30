<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Requirement extends Model {

    public $timestamps = false;

    public static function show_all_jobs($experience, $gender, $status, $type, $department, $position, $state, $city) {
        $sql = "SELECT 
                a.id, a.employer_id, a.desired_gender, a.job_experience, 
                CASE
                    WHEN a.job_status=1 THEN 'Pending' 
                    WHEN a.job_status=2 THEN 'Completed' 
                END AS job_status, 
                CASE
                    WHEN a.job_status=1 THEN 'danger' 
                    WHEN a.job_status=2 THEN 'success' 
                END AS job_status_class, 
                b.name AS department, 
                c.name AS position, 
                d.name AS state, 
                e.name AS city, 
                f.name AS job_type 
                FROM requirements AS a 
                LEFT JOIN job_department AS b ON a.desired_department_id=b.id 
                LEFT JOIN job_position AS c ON a.desired_position_id=c.id 
                LEFT JOIN states AS d ON a.desired_state_id=d.id 
                LEFT JOIN cities AS e ON a.desired_city_id=e.id 
                LEFT JOIN job_type AS f ON a.job_work_type_id=f.id 
                WHERE a.employer_id IS NOT NULL";

        if ($experience) {
            $sql .= " AND a.job_experience='$experience'";
        }

        if ($gender) {
            $sql .= " AND a.desired_gender='$gender'";
        }

        if ($status) {
            $sql .= " AND a.job_status='$status'";
        }

        if ($type) {
            $sql .= " AND a.job_work_type_id='$type'";
        }

        if ($department) {
            $sql .= " AND a.desired_department_id='$department'";
        }

        if ($position) {
            $sql .= " AND a.desired_position_id='$position'";
        }

        if ($state) {
            $sql .= " AND a.desired_state_id='$state'";
        }

        if ($city) {
            $sql .= " AND a.desired_city_id='$city'";
        }


        return DB::select($sql);
    }

    public static function fetch_employer_jobs($id) {
        return DB::table('requirements')
            ->select(DB::raw("requirements.id AS job_id, DATE_FORMAT(requirements.created_at, '%D %b %Y - %h:%i %p') AS datetime, 
                CASE
                    WHEN requirements.job_status=1 THEN 'Pending' 
                    WHEN requirements.job_status=2 THEN 'Completed' 
                END AS status, 
                CASE
                    WHEN requirements.job_status=1 THEN 'danger' 
                    WHEN requirements.job_status=2 THEN 'success' 
                END AS status_class,
                job_department.name AS department,
                job_position.name AS position"))
            ->leftJoin('job_department', 'requirements.desired_department_id', '=', 'job_department.id')
            ->leftJoin('job_position', 'requirements.desired_position_id', '=', 'job_position.id')
            ->where('requirements.employer_id', $id)
            ->get();
    }

    public static function view_job($id) {
        return DB::table('requirements')
            ->select(DB::raw("requirements.id, requirements.employer_id, requirements.desired_gender, requirements.company_name, requirements.company_address, requirements.company_website, requirements.total_candidates, requirements.needed_candidates, requirements.job_experience, DATE_FORMAT(requirements.created_at, '%D %b %Y - %h:%i %p') AS datetime, requirements.contact_person_name, requirements.contact_person_mobile, 
                CASE
                    WHEN requirements.job_status=1 THEN 'Pending' 
                    WHEN requirements.job_status=2 THEN 'Completed' 
                END AS job_status, 
                CASE
                    WHEN requirements.job_status=1 THEN 'danger' 
                    WHEN requirements.job_status=2 THEN 'success' 
                END AS job_status_class, 
            job_department.name AS department, 
            job_position.name AS position, 
            states.name AS state, 
            cities.name AS city, 
            job_type.name AS job_type, 
            a.name AS contact_person_position, 
            employers.full_name AS posted_by"))
            ->leftJoin('job_department', 'requirements.desired_department_id', '=', 'job_department.id')
            ->leftJoin('job_position', 'requirements.desired_position_id', '=', 'job_position.id')
            ->leftJoin('job_type', 'requirements.job_work_type_id', '=', 'job_type.id')
            ->leftJoin('job_position as a', 'requirements.contact_person_position_id', '=', 'a.id')
            ->leftJoin('states', 'requirements.desired_state_id', '=', 'states.id')
            ->leftJoin('cities', 'requirements.desired_city_id', '=', 'cities.id')
            ->leftJoin('employers', 'requirements.employer_id', '=', 'employers.id')
            ->where('requirements.id', $id)
            ->first();
    }

    public static function fetch_job_status($id) {
        return DB::table('requirement_status')
            ->select(DB::raw("requirement_status.status, requirement_status.description, DATE_FORMAT(requirement_status.created_at, '%D %b %Y - %h:%i %p') AS datetime,
            CASE
                WHEN requirement_status.status=1 THEN 'Pending' 
                WHEN requirement_status.status=2 THEN 'Completed' 
                END AS status, 
            CASE
                WHEN requirement_status.status=1 THEN 'danger' 
                WHEN requirement_status.status=2 THEN 'success' 
                END AS status_class,  
            users.name AS user"))
            ->leftJoin('users', 'requirement_status.user_id', '=', 'users.id')
            ->where('requirement_status.requirement_id', $id)
            ->latest('requirement_status.created_at')
            ->get();
    }

    public static function update_candidate_count($data) {
        return Requirement::where('id', $data['id'])->update(['needed_candidates' => $data['needed_candidates']]);
    }

    public static function update_job_status($data) {
        if ($data['status'] == 2) {
            $job = Requirement::find($data['requirement_id']);
            $job->job_status = $data['status'];
            $job->save();
        }

        return DB::table('requirement_status')->insert($data);  
    }

    public static function fetch_job($id) {
        return Requirement::find($id);
    }

    public static function update_requirement($requirement) {
        return Requirement::where('id', $requirement['id'])->update($requirement);
    }

    public static function delete_job($id) {
        Requirement::destroy($id);
    }
}