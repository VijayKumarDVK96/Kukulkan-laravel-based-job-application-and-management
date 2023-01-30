<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ApplyOnlineReport;

class ApplyOnlineReportController extends Controller {

    public function pending_online_reports() {
        $data['title'] = "Pending Tutors Lists";
        $data['candidates'] = ApplyOnlineReport::apply_online_reports(0);
        return view('admin.apply-online-reports')->with($data);
    }

    public function approved_online_reports() {
        $data['title'] = "Approved Tutors Lists";
        $data['candidates'] = ApplyOnlineReport::apply_online_reports(1);
        return view('admin.apply-online-reports')->with($data);
    }

    public function change_apply_online_reports_status(Request $request) {
        if($request->select) {
            if($request->change_status == 'Approve') {
                ApplyOnlineReport::approve_online_reports($request->select);
                $message = 'Profile Approved';
            } else if($request->change_status == 'Delete') {
                ApplyOnlineReport::delete_online_reports($request->select);
                $message = 'Profile Deleted';
            }
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'No Candidates Selected');
        }  
    }

}
