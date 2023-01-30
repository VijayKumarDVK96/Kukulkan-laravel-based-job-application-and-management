<?php

namespace App\Http\Models;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'mobile', 'address'];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];

    public function roles() {
        return $this->belongsToMany('App\Http\Models\Role');
    }

    // Mutator
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public static function counts_summary() {
        return DB::select('select count(id) as candidates, (select count(id) from employers) as employers, (select count(id) from requirements) as requirements, (select count(id) from candidates where profile_status is NULL) as pending_candidates from candidates')[0];
    }

    public static function monthly_summary() {
        $candidates = DB::select("SELECT 
                    month(created_at) as months, count(id) as count FROM candidates 
                    WHERE YEAR(created_at) = YEAR(CURDATE()) 
                    GROUP BY month(created_at)");
        $employers = DB::select("SELECT 
                    month(created_at) as months, count(id) as count FROM employers 
                    WHERE YEAR(created_at) = YEAR(CURDATE()) 
                    GROUP BY month(created_at)");

        // echo '<pre>';print_r($candidates);exit;

        for ($a = 0; $a < 12; $a++) {
            $monthly_summary[$a]['month'] = date("Y-m", mktime(0, 0, 0, $a+1));
            $monthly_summary[$a]['candidates'] = 0;
            $monthly_summary[$a]['employers'] = 0;

            foreach ($candidates as $value) {
                if($a+1 == $value->months)
                $monthly_summary[$a]['candidates'] = $value->count;
            }

            foreach ($employers as $value) {
                if($a+1 == $value->months)
                $monthly_summary[$a]['employers'] = $value->count;
            }
        }

        return $monthly_summary;
    }

    public static function gender_summary() {
        return DB::select("SELECT
                COUNT(CASE WHEN gender = 'male' THEN id END) AS male,
                COUNT(CASE WHEN gender = 'female' THEN id END) AS female 
                FROM candidates");
    }

    public static function update_profile($data) {
        $user = User::findOrFail($data['id']);

        if(isset($data['name']) && isset($data['email']) && isset($data['mobile']) && isset($data['address'])) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->mobile = $data['mobile'];
            $user->address = $data['address'];
        }

        if (isset($data['password']))
        $user->password = $data['password'];
        
        $user->save();
    }

    /********************/
    /*******STAFFS*******/
    /********************/

    public static function fetch_staffs() {
        return User::whereHas('roles', function ($query) {
                    $query->where('role', 'staff');
               })->get();
    }

    public static function fetch_staff($id) {
        return User::findOrfail($id);
    }

    public static function add_staff($data) {
        $user = User::create($data);
        $user->roles()->sync([2]);
    }
}