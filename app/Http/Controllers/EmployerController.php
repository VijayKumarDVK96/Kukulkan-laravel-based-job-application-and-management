<?php

namespace App\Http\Controllers;

use App\Http\Models\Employer;
use App\Http\Models\Requirement;
use App\Http\Requests\EmployerStoreRequest;
use Illuminate\Http\Request;

class EmployerController extends HelperController {
    
    public function __construct() {
        // DB::enableQueryLog();
    }

    /********************/
    /*******CREATE*******/
    /********************/

    public function create_employer(EmployerStoreRequest $request) {
        $referer = request()->headers->get('referer');
        $employer = $request->validated();

        if (strpos($referer, 'admin')) {
            $employer['profile_status'] = 1;
        }

        Employer::create_employer($employer, session('requirement'));

        return response()->json(['status' => 'success', 'message' => 'Application Submitted']);
    }

    /********************/
    /********READ********/
    /********************/

    public function employers() {
        $data['employers'] = Employer::show_employers(1);
        return view('admin.employers')->with($data);
    }

    public function add_employer() {
        $data['experience'] = $this->experience;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['states'] = $this->states();
        $data['salary_range'] = $this->salary_range();
        $data['job_type'] = $this->job_type();
        return view('admin.add-employer')->with($data);
    }

    public function new_employers() {
        $data['employers'] = Employer::show_employers(0);
        // echo '<pre>';print_r($data);exit;
        return view('admin.new-employers')->with($data);
    }

    public function view_employer($id) {
        $data['id'] = $id;
        $data['employer'] = Employer::fetch_employer($id);
        $data['jobs'] = Requirement::fetch_employer_jobs($id);
        // \Debugbar::info($data['jobs']);
        // echo '<pre>';print_r($data['jobs']);exit;

        return view('admin.view-employer')->with($data);
    }

    public function edit_employer($id) {
        $data['id'] = $id;
        $data['employer'] = Employer::edit_employer($id);
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        // dd(DB::getQueryLog());

        return view('admin.edit-employer')->with($data);
    }

    /********************/
    /*******UPDATE*******/
    /********************/

    public function update_employer(EmployerStoreRequest $request) {

        $employer = $request->validated();
        $employer['id'] = $request->id;
        Employer::update_employer($employer);

        return response()->json(['status' => 'success', 'message' => 'Employer Updated']);
    }

    public function change_employer_profile_status(Request $request) {
        if($request->select) {
            if($request->change_status == 'Approve') {
                Employer::approve_new_employers($request->select);
                $message = 'New Employers Approved';
            } else if($request->change_status == 'Delete') {
                Employer::delete_new_employers($request->select);
                $message = 'New Employers Deleted';
            }
            return redirect('admin/new-employers')->with('message', $message);
        } else {
            return redirect('admin/new-employers');
        }  
    }

    /********************/
    /*******DELETE*******/
    /********************/

    public function delete_employer($id) {
        Employer::delete_employer($id);
    }
}