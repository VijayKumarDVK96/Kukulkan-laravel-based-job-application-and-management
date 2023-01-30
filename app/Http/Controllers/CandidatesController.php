<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Models\Candidate;
use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\CollegeStoreRequest;
use App\Http\Requests\CandidateStoreRequest;
use App\Http\Requests\CandidateUpdateRequest;

class CandidatesController extends HelperController {

    /********************/
    /*******CREATE*******/
    /********************/

    public function test(Request $request) {
        $data = explode('/', $_SERVER['REQUEST_URI']);
        echo '<pre>';print_r($data);
        // echo '<pre>';print_r($request->path());
        // DB::enableQueryLog();
        // $query = DB::getQueryLog();
        // dd($query);
    }

    public function add_school(SchoolStoreRequest $request) {
        $school = session('school');
        $school[] = $request->validated();
        session()->put('school', $school);
        $data = ['status' => 'success', 'message' => ['id' => array_key_last($school)]];
        return response()->json($data);
    }

    public function add_college(CollegeStoreRequest $request) {
        $college = session('college');
        $college[] = $request->validated();
        session()->put('college', $college);
        $data = ['status' => 'success', 'message' => ['id' => array_key_last($college)]];
        return response()->json($data);
    }

    public function create_candidate(CandidateStoreRequest $request) {

        $referer = request()->headers->get('referer');
        
        $candidates = [
            'full_name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'pin' => $request->pin,
            'experience' => $request->experience,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'desired_department_id' => $request->desired_department,
            'desired_position_id' => $request->desired_position,
            'desired_state_id' => $request->desired_state,
            'desired_city_id' => $request->desired_city,
            'dob' => $request->dob,
            'about_me' => ($request->about_me) ? $request->about_me : '',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if(strpos($referer, 'admin')) {
            $candidates['profile_status'] = 1;
        }

        if($request->experience == 'experienced') {
            $experience = [
                'is_working' => $request->working,
                'last_company' => $request->last_company,
                'current_salary_range_id' => $request->current_salary_range,
                'expected_salary_range_id' => $request->expected_salary_range,
                'years_of_experience' => $request->years_of_experience,
                'notice_period_id' => $request->notice_period,
            ];
        } else {
            $experience = [];
        }
            
        Candidate::create_candidate($candidates, $experience, session('school'), session('college'));
        $this->unset_education();
        
        return response()->json(['status' => 'success', 'message' => 'Application Submitted']);
    }

    public function add_status(Request $request, $candiate_id) {
        $data = [
            'candidate_id' => $candiate_id,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'description' => $request->description
        ];
        
        Candidate::add_candidate_status($data);
        return redirect()->back();
    }

    /********************/
    /********READ********/
    /********************/

    public function candidates(Request $request) {
        $data['experience'] = $this->experience;
        $data['gender'] = $this->gender;
        $data['status'] = $this->status;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['degree'] = $this->graduation_degree();
        $data['states'] = $this->states();
        if ($request->state) {
            $data['cities'] = $this->cities($request->state);
        }
        $data['candidates'] = Candidate::show_all_candidates($request->experience, $request->gender, $request->status, $request->department, $request->position, $request->state, $request->city, $request->degree, $request->from_age, $request->to_age);

        // \Debugbar::info(Auth::user());

        return view('admin.candidates')->with($data);
    }

    public function add_candidate() {
        $data['experience'] = $this->experience;
        $data['gender'] = $this->gender;
        $data['status'] = $this->status;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['degree'] = $this->graduation_degree();
        $data['states'] = $this->states();
        $data['salary_range'] = $this->salary_range();
        $data['notice_period'] = $this->notice_period();
        $data['school_class'] = $this->school_class();
        $data['school_board'] = $this->school_board();
        $data['school_medium'] = $this->school_medium();
        $data['total_marks'] = $this->total_marks();
        $data['type'] = $this->graduation_type();
        $data['degree'] = $this->graduation_degree();
        $data['major'] = $this->graduation_major();
        $data['year'] = $this->year();

        return view('admin.add-candidate')->with($data);
    }

    public function new_candidates() {
        $data['candidates'] = Candidate::new_candidates();
        return view('admin.new-candidates')->with($data);
    }

    public function view_candidate($id) {
        $data['id'] = $id;
        $data['status'] = $this->status;
        $data['candidate'] = Candidate::fetch_candidate($id);
        $data['school'] = Candidate::fetch_candidate_school($id);
        $data['college'] = Candidate::fetch_candidate_college($id);
        $data['job_status'] = Candidate::fetch_candidate_status($id);

        return view('admin.view-candidate')->with($data);
    }

    public function edit_candidate($id) {
        $data['candidate'] = Candidate::edit_candidate($id);
        $data['candidate_school'] = Candidate::fetch_candidate_school_id($id);
        $data['candidate_college'] = Candidate::fetch_candidate_college_id($id);
        // echo "<pre>";print_r($data);exit;
        $data['id'] = $id;
        $data['experience'] = $this->experience;
        $data['gender'] = $this->gender;
        $data['status'] = $this->status;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['degree'] = $this->graduation_degree();
        $data['states'] = $this->states();
        $data['salary_range'] = $this->salary_range();
        $data['notice_period'] = $this->notice_period();
        $data['school_class'] = $this->school_class();
        $data['school_board'] = $this->school_board();
        $data['school_medium'] = $this->school_medium();
        $data['total_marks'] = $this->total_marks();
        $data['type'] = $this->graduation_type();
        $data['degree'] = $this->graduation_degree();
        $data['major'] = $this->graduation_major();
        $data['year'] = $this->year();

        return view('admin.edit-candidate')->with($data);
    }

    /********************/
    /*******UPDATE*******/
    /********************/

    public function update_candidate(CandidateUpdateRequest $request) {

        $candidates = [
            'id' => $request->id,
            'full_name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'pin' => $request->pin,
            'experience' => $request->experience,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'desired_department_id' => $request->desired_department,
            'desired_position_id' => $request->desired_position,
            'desired_state_id' => $request->desired_state,
            'desired_city_id' => $request->desired_city,
            'dob' => $request->dob,
            'about_me' => ($request->about_me) ? $request->about_me : '',
        ];

        $experience = $school = $college = [];

        if($request->experience == 'experienced') {
            $experience = [
                'is_working' => $request->working,
                'last_company' => $request->last_company,
                'current_salary_range_id' => $request->current_salary_range,
                'expected_salary_range_id' => $request->expected_salary_range,
                'years_of_experience' => $request->years_of_experience,
                'notice_period_id' => $request->notice_period,
            ];
        }

        if(isset($request->school_id) && !empty($request->school_id)) {
            for ($i = 0; $i < count($request->school_id); $i++) {
                $school[] = [
                    'id' => $request->school_id[$i],
                    'school_class_id' => $request->school_class[$i],
                    'school_board_id' => $request->school_board[$i],
                    'school_medium_id' => $request->school_medium[$i],
                    'total_marks_id' => $request->school_total_marks[$i],
                    'school_name' => $request->school_name[$i],
                    'passed_out_year' => $request->school_passed_out_year[$i]
                ];
            }
        }

        if (isset($request->college_id) && !empty($request->college_id)) {
            for ($j = 0; $j < count($request->college_id); $j++) {
                $college[] = [
                    'id' => $request->college_id[$j],
                    'graduation_type_id' => $request->graduation_type[$j],
                    'graduation_degree_id' => $request->graduation_degree[$j],
                    'graduation_major_id' => $request->graduation_major[$j],
                    'total_marks_id' => $request->college_total_marks[$j],
                    'college_name' => $request->college_name[$j],
                    'passed_out_year' => $request->college_passed_out_year[$j]
                ];
            }
        }

        Candidate::update_candidate($candidates, $experience, $school, $college);
        return response()->json(['status' => 'success', 'message' => 'Candidate Updated!']);
    }

    public function change_candidate_profile_status(Request $request) {
        if($request->select) {
            if($request->change_status == 'Approve') {
                Candidate::approve_new_candidates($request->select);
                $message = 'New Candidates Approved';
            } else if($request->change_status == 'Delete') {
                $candidates = Candidate::fetch_candidates_resumes($request->select);

                foreach ($candidates as $value) {
                    $filepath = 'resumes\\'. $value->resume;
                    if ($value->resume) {
                        unlink(public_path($filepath));
                    }
                    Candidate::delete_new_candidates($request->select);
                }
                
                $message = 'New Candidates Deleted';
            }
            return redirect('admin/new-candidates')->with('success', $message);
        } else {
            return redirect('admin/new-candidates')->with('error', 'No Candidates Selected');
        }  
    }

    /********************/
    /*******DELETE*******/
    /********************/

    public function delete_profile($id) {
        $candidates = Candidate::fetch_candidates_resumes([$id]);

        if(!empty($candidates)) {
            foreach($candidates as $candidate) {
                $filepath = 'resumes\\' . $candidate->resume;
                if ($candidate->resume) {
                    unlink(public_path($filepath));
                }
            }
        }
        
        Candidate::delete_profile($id);
    }

    public function unset_education() {
        session()->forget('school');
        session()->forget('college');
    }

    public function unset_school($id) {
        $school = session('school');
        unset($school[$id]);
        session()->put('school', $school);
    }

    public function unset_college($id) {
        $college = session('college');
        unset($college[$id]);
        session()->put('college', $college);
    }
}