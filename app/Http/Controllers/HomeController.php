<?php

namespace App\Http\Controllers;
use DB;

use App\Http\Models\Candidate;
use App\Http\Models\Seo;
use App\Http\Models\Setting;
use App\Http\Requests\SetApplyOnlineRequest;
use App\Http\Requests\SetCandidateStoreRequest;
use App\Http\Requests\SetEmployerStoreRequest;
use App\Http\Requests\SubmitEnquiryRequest;
use App\Http\Requests\UploadResumeStoreRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class HomeController extends HelperController {

    /********************/
    /*******CREATE*******/
    /********************/

    public function set_candidate(SetCandidateStoreRequest $request) {
        return response()->json(['status' => 'success', 'message' => 'Candidate Validated']);
    }

    public function set_employer(SetEmployerStoreRequest $request) {
        return response()->json(['status' => 'success', 'message' => 'Employer Validated']);
    }

    public function upload(UploadResumeStoreRequest $request) {
        $candidate_id = session('candidate_id');
        $fileName = time().'.'.$request->resume->extension();
        $request->resume->move(public_path('resumes'), $fileName);

        Candidate::upload_resume($fileName, $candidate_id);
        session()->forget('candidate_id');
            
        return response()->json(['status' => 'success', 'message' => 'Resume Uploaded Successfully!']);
    }

    public function submit_enquiry(SubmitEnquiryRequest $request) {

        $mail['name'] = $request->name;
        $mail['mobile'] = $request->mobile;
        $mail['email'] = $request->email;
        $mail['contact_message'] = $request->message;

        Mail::send('contact-enquiry-submit-mail', $mail, function ($message) {
            // $message->to("info@kukulkan.in", "Kukulkan")
            $message->to("info@kukulkan.in", "Kukulkan")
                ->cc(['vijay.dvk96@gmail.com', 'Vijay Kumar'])
                ->from("info@kukulkan.in", "Kukulkan")
                ->subject('Contact Form Enquiry');
        });

        if (Mail::failures()) {
            $data = ['status' => 'success', 'message' => 'Mail Failed to Send...'];
        } else {
            $data = ['status' => 'success', 'message' => 'Thank you for contacting us. We will get back to you soon...'];
        }
        
        return response()->json($data);
    }

    public function apply_job_online(SetApplyOnlineRequest $request) {

        $data = $request->validated();
        $data['created_at'] = date('Y-m-d h:i:s');
        
        DB::table('apply_online_reports')->insert($data);
        return response()->json(['status' => 'success', 'message' => 'Application Submitted Successfully!! We will get back to you soon.']);
    }

    /********************/
    /********READ********/
    /********************/

    public function index() {
        $data['seo'] = Seo::fetch_seo('home');
        $data['contact_details'] = Setting::configuration();
        return view('index', $data);
    }

    public function __invoke() {
        $request = request()->segment(1);
        $data['seo'] = Seo::fetch_seo($request);

        if($request == 'contact') {
            $data['contact_details'] = Setting::configuration();
        } else if($request == 'apply-online') {
            $data['states'] = $this->states();
            $data['cities'] = $this->cities(35);
        }

        return view($request, $data);
    }

    public function service($type = '') {
        $data['seo'] = Seo::fetch_seo('service');
        $data['type'] = $type;
        return view('service', $data);
    }

    public function apply_job_details(Request $request) {
        $data['details'] = $request->only(['name', 'mobile', 'email']);
        $data['seo'] = Seo::fetch_seo('apply-job-details');
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

        return view('apply-job-details')->with($data);
    }

    public function upload_resume() {
        return session('candidate_id') ? view('upload-resume') : redirect('/');
    }

    public function post_job_details(Request $request) {
        $data['details'] = $request->only(['name', 'mobile', 'email']);
        $data['seo'] = Seo::fetch_seo('post-job-details');
        $data['experience'] = $this->experience;
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['states'] = $this->states();
        $data['salary_range'] = $this->salary_range();
        $data['job_type'] = $this->job_type();
        return view('post-job-details')->with($data);
    }

}