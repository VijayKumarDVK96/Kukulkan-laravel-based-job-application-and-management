<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait AuthTrait {
    
    public function auth_info() {
        $this->middleware('admin');
        return Auth::user();
    }
}
