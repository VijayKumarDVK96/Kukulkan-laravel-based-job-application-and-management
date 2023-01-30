<?php

namespace App\Http\Models;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model {

    public $timestamps = false;

    protected $fillable = ['full_name', 'email', 'mobile', 'pin', 'experience', 'gender', 'marital_status', 'desired_department_id', 'desired_position_id', 'desired_state_id', 'desired_city_id', 'dob', 'about_me', 'resume', 'job_status', 'profile_status', 'created_at'];

    /********************/
    /*******CREATE*******/
    /********************/

    public static function create_candidate($candidates, $experience, $school, $college) {
        $insert_id = Candidate::insertGetId($candidates);
        session()->put('candidate_id', $insert_id);

        if(isset($experience) && !empty($experience)) {
            $experience['candidate_id'] = $insert_id;
            DB::table('experience')->insert($experience);
        }

        if(isset($school) && !empty($school)) {
            foreach ($school as $value) {
                $value['candidate_id'] = $insert_id;
                DB::table('school')->insert($value);
            }
        }

        if(isset($college) && !empty($college)) {
            foreach ($college as $value) {
                $value['candidate_id'] = $insert_id;
                DB::table('college')->insert($value);
            }
        }

        return $insert_id;
    }

    public static function upload_resume($resume, $id) {
        return Candidate::where('id', $id)->update(['resume' => $resume]);
    }

    public static function add_candidate_status($data) {
        if ($data['status'] == 2) {
            $candidate = Candidate::find($data['candidate_id']);
            $candidate->job_status = $data['status'];
            $candidate->save();
        }

        return DB::table('candidate_status')->insert($data);  
    }

    /********************/
    /********READ********/
    /********************/

    public static function new_candidates() {
        return DB::select("SELECT 
                a.id, a.full_name, TIMESTAMPDIFF(YEAR, a.dob, CURDATE()) AS age, a.email, a.mobile, a.pin, a.experience, a.gender, b.name AS job_department, c.name AS job_position, d.name AS job_state, e.name AS job_city, DATE_FORMAT(a.created_at, '%D %b %Y - %h:%i %p') AS created_at  
                FROM candidates AS a 
                LEFT JOIN job_department AS b ON a.desired_department_id=b.id 
                LEFT JOIN job_position AS c ON a.desired_position_id=c.id 
                LEFT JOIN states AS d ON a.desired_state_id=d.id 
                LEFT JOIN cities AS e ON a.desired_city_id=e.id 
                WHERE profile_status IS NULL ORDER BY a.id DESC");
    }

    public static function show_all_candidates($experience, $gender, $status, $department, $position, $state, $city, $degree, $from_age, $to_age) {
        $sql = "SELECT a.id, a.full_name, TIMESTAMPDIFF(YEAR, a.dob, CURDATE()) AS age, a.email, a.mobile, a.experience, a.gender, a.job_status, b.name AS job_department, c.name AS job_position, d.name AS job_state, e.name AS job_city, CONCAT(g.name, ' - ', h.name) AS education, DATE_FORMAT(a.created_at, '%D %b %Y - %h:%i %p') AS created_at, 
        CASE
            WHEN a.job_status=1 THEN 'Pending'
            WHEN a.job_status=2 THEN 'Completed' 
        END AS job_status, 
        CASE
            WHEN a.job_status=1 THEN 'danger' 
            WHEN a.job_status=2 THEN 'success' 
        END AS job_status_class 
        FROM candidates AS a 
        LEFT JOIN job_department AS b ON a.desired_department_id=b.id 
        LEFT JOIN job_position AS c ON a.desired_position_id=c.id 
        LEFT JOIN states AS d ON a.desired_state_id=d.id 
        LEFT JOIN cities AS e ON a.desired_city_id=e.id 
        LEFT JOIN college AS f ON f.candidate_id=a.id 
        LEFT JOIN graduation_degree AS g on f.graduation_degree_id=g.id 
        LEFT JOIN graduation_major AS h on f.graduation_major_id=h.id 
        WHERE profile_status=1";

        if ($experience) {
            $sql .= " AND a.experience='$experience'";
        }

        if ($gender) {
            $sql .= " AND a.gender='$gender'";
        }

        if ($status) {
            $sql .= " AND a.job_status='$status'";
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

        if ($degree) {
            $sql .= " AND f.graduation_degree_id='$degree'";
        }

        if ($from_age) {
            $sql .= " AND TIMESTAMPDIFF(YEAR, a.dob, CURDATE()) BETWEEN $from_age AND $to_age";
        }

        $sql .= " ORDER BY a.id DESC";

        return DB::select($sql);
    }

    public static function fetch_candidates_resumes($select) {
        return Candidate::select('resume')->whereIn('id', $select)->get();
    }

    public static function edit_candidate($id) {
        return DB::select("SELECT 
                a.id, a.full_name, a.email, a.mobile, a.pin, a.experience, a.gender, a.marital_status, a.desired_department_id, a.desired_position_id, a.desired_state_id, a.desired_city_id, a.dob, a.about_me, b.* 
                FROM candidates AS a 
                LEFT JOIN experience AS b ON b.candidate_id = a.id 
                WHERE a.id=$id")[0];
    }

    public static function fetch_candidate($id) {
        return DB::select("SELECT 
                    a.full_name, TIMESTAMPDIFF(YEAR, a.dob, CURDATE()) AS age, a.gender, a.resume, DATE_FORMAT(a.created_at, '%D %b %Y - %h:%i %p') AS datetime, a.email, a.mobile, a.experience, a.pin, a.about_me,
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
                    f.is_working, f.last_company, f.years_of_experience, 
                    g.name AS current_salary, 
                    h.name AS expected_salary, 
                    i.name AS notice_period 
                    FROM candidates AS a 
                    LEFT JOIN job_department AS b ON a.desired_department_id = b.id 
                    LEFT JOIN job_position AS c ON a.desired_position_id = c.id 
                    LEFT JOIN states AS d ON a.desired_state_id = d.id 
                    LEFT JOIN cities AS e ON a.desired_city_id = e.id 
                    LEFT JOIN experience AS f ON f.candidate_id = a.id 
                    LEFT JOIN salary_range AS g ON f.current_salary_range_id = g.id 
                    LEFT JOIN salary_range AS h ON f.expected_salary_range_id = h.id 
                    LEFT JOIN notice_period AS i ON f.notice_period_id = i.id 
                    WHERE a.id=$id")[0];
    }

    public static function fetch_candidate_school($id) {
        return DB::select("SELECT 
                b.school_name AS name, b.passed_out_year AS year, 
                c.name AS class, 
                d.name AS board, 
                e.name AS medium, 
                CONCAT('(', f.name, ')') AS marks 
                FROM candidates AS a 
                LEFT JOIN school AS b ON b.candidate_id = a.id 
                LEFT JOIN school_class AS c ON b.school_class_id = c.id 
                LEFT JOIN school_board AS d ON b.school_board_id = d.id 
                LEFT JOIN school_medium AS e ON b.school_medium_id = e.id 
                LEFT JOIN total_marks AS f ON b.total_marks_id = f.id 
                WHERE a.id=$id ORDER BY b.passed_out_year DESC");
    }

    public static function fetch_candidate_college($id) {
        return DB::select("SELECT 
                b.college_name AS name, b.passed_out_year AS year, 
                c.name AS graduation_type, 
                d.name AS graduation_degree, 
                e.name AS graduation_major, 
                CONCAT('(', f.name, ')') AS marks 
                FROM candidates AS a 
                LEFT JOIN college AS b ON b.candidate_id = a.id  
                LEFT JOIN graduation_type AS c ON b.graduation_type_id = c.id 
                LEFT JOIN graduation_degree AS d ON b.graduation_degree_id = d.id 
                LEFT JOIN graduation_major AS e ON b.graduation_major_id = e.id 
                LEFT JOIN total_marks AS f ON b.total_marks_id = f.id 
                WHERE a.id=$id ORDER BY b.passed_out_year DESC");
    }

    public static function fetch_candidate_school_id($id) {
        return DB::table('school')->where('candidate_id', $id)->get(); 
    }

    public static function fetch_candidate_college_id($id) {
        return DB::table('college')->where('candidate_id', $id)->get(); 
    }

    public static function fetch_candidate_status($id) {
        return DB::select("SELECT 
                a.status, a.description, DATE_FORMAT(a.created_at, '%D %b %Y - %h:%i %p') AS datetime,
                CASE
                    WHEN a.status=1 THEN 'Pending' 
                    WHEN a.status=2 THEN 'Completed' 
                END AS status, 
                CASE
                    WHEN a.status=1 THEN 'danger' 
                    WHEN a.status=2 THEN 'success' 
                END AS status_class,  
                b.name AS user 
                FROM candidate_status AS a 
                LEFT JOIN users AS b ON a.user_id=b.id 
                WHERE a.candidate_id='$id' 
                ORDER BY a.created_at DESC");
    }

    /********************/
    /*******UPDATE*******/
    /********************/

    public static function update_candidate($candidates, $experience, $school, $college) {
        $candidate_id = $candidates['id'];
        unset($candidates['id']);
        Candidate::whereId($candidate_id)->update($candidates);

        if(!empty($experience)) {
            $result = DB::table('experience')->where('candidate_id', $candidate_id);
            if(isset($result) && count($result) == 1) {
                DB::table('experience')->where('candidate_id', $candidate_id)->limit(1)->update($experience);
            } else {
                $experience['candidate_id'] = $candidate_id;
                DB::table('experience')->insert($experience);
            }
        }

        if(!empty($school)) {
            foreach ($school as $value) {
                DB::table('school')->where('id', $value['id'])->limit(1)->update($value); 
            }
        }

        if (!empty($college)) {
            foreach ($college as $value) {
                DB::table('college')->where('id', $value['id'])->limit(1)->update($value);
            }
        }
    }

    public static function approve_new_candidates($select) {
        return Candidate::whereIn('id', $select)->update(['profile_status' => 1]);
    }

    /********************/
    /*******DELETE*******/
    /********************/

    public static function delete_new_candidates($select) {
        return Candidate::whereIn('id', $select)->delete();
    }

    public static function delete_profile($id) {
        return Candidate::destroy($id);
    }
}