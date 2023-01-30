<?php

namespace App\Http\Controllers;

use Cache;
use App\Http\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordStoreRequest;

class AdminController extends Controller {

    public function login() {
        return view('admin.login');
    }

    public function dashboard() {
        // \Debugbar::info($data['count']);
        $data['count'] = Cache::remember('count', 300, function () {
            return User::counts_summary();
        });

        $data['summary'] = Cache::remember('monthly_summary', 300, function () {
            return User::monthly_summary();
        });
        
        // echo '<pre>';print_r(User::gender_summary());exit;

        $data['gender_summary'] = Cache::remember('gender_summary', 300, function () {
            return User::gender_summary();
        });

        return view('admin.dashboard')->with($data);
    }

    public function view_profile() {
        return view('admin.view-profile');
    }

    public function update_profile(UpdateProfileRequest $request) {
        $data = $request->validated();
        $data['id'] = $request->id;
        User::update_profile($data);
    }

    public function update_password(UpdatePasswordStoreRequest $request) {
        $data = [
            'password' => $request->new_password,
            'id' => auth()->id()
        ];
        User::update_profile($data);
    }

    /********************/
    /*******STAFFS*******/
    /********************/

    public function staffs() {
        $data['staffs'] = User::fetch_staffs();
        return view('admin.staffs')->with($data);
    }

    public function add_staff(UpdateProfileRequest $request) {
        User::add_staff($request->validated());
    }

    public function edit_staff($id) {
        return User::fetch_staff($id)->toJson();
    }

    public function delete_staff($id) {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}