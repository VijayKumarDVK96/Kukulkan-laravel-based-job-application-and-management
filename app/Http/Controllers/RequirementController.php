<?php

namespace App\Http\Controllers;

use App\Http\Models\Requirement;
use App\Http\Requests\SetRequirementStoreRequest;
use Illuminate\Http\Request;

class RequirementController extends HelperController {

    /********************/
    /*******CREATE*******/
    /********************/

    public function add_requirement(SetRequirementStoreRequest $request) {
        $requirement = session('requirement');
        $requirement[] = $request->validated();
        session()->put('requirement', $requirement);
        
        return response()->json(['status' => 'success', 'message' => ['id' => array_key_last($requirement)]]);
    }

    /********************/
    /********READ********/
    /********************/
    
    public function jobs(Request $request) {
        $data['experience'] = $this->experience;
        $data['gender'] = $this->gender;
        $data['status'] = $this->status;
        $data['job_type'] = $this->job_type();
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['states'] = $this->states();
        if ($request->state) {
            $data['cities'] = $this->cities($request->state);
        }
        $data['jobs'] = Requirement::show_all_jobs($request->experience, $request->gender, $request->status, $request->type, $request->department, $request->position, $request->state, $request->city);

        return view('admin.jobs')->with($data);
    }

    public function view_job($id) {
        $data['id'] = $id;
        $data['status'] = $this->status;
        $data['job'] = Requirement::view_job($id);
        $data['job_status'] = Requirement::fetch_job_status($id);
        // echo "<pre>";print_r($data['job']);exit;

        return view('admin.view-job')->with($data);
    }

    public function edit_job($id) {
        $data['id'] = $id;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['states'] = $this->states();
        $data['experience'] = $this->experience;
        $data['gender'] = $this->gender;
        $data['salary_range'] = $this->salary_range();
        $data['job_type'] = $this->job_type();
        $data['job'] = Requirement::fetch_job($id);

        return view('admin.edit-job')->with($data);
    }

    /********************/
    /*******UPDATE*******/
    /********************/

    public function update_candidate_count(Request $request, $id) {
        if($request->all()) {
            $data = ['id' => $id, 'needed_candidates' => $request->needed_candidates];
            Requirement::update_candidate_count($data);
        }
        
        return back();
    }

    public function update_status(Request $request, $job_id) {
        if($request->all()) {
            $data = [
                'requirement_id' => $job_id,
                'user_id' => auth()->id(),
                'status' => $request->status,
                'description' => $request->description
            ];
            Requirement::update_job_status($data);
        }
        return back();
    }

    public function update_requirement(SetRequirementStoreRequest $request) {

        $requirement = $request->validated();
        $requirement['id'] = $request->id;
        Requirement::update_requirement($requirement);
        
        return response()->json(['status' => 'success', 'message' => 'Job Updated Successfully']);
    }

    /********************/
    /*******DELETE*******/
    /********************/

    public function delete_job($id) {
        Requirement::delete_job($id);
    }

    public function unset_job($id) {
        $requirement = session('requirement');
        unset($requirement[$id]);
        session()->put('requirement', $requirement);
    }

    public function unset_requirement() {
        session()->forget('requirement');
    }
}