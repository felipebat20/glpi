<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as User;
use App\Models\Technician as Tech;
use App\Models\Manager as Admin;
use App\Models\Session as Session;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $matchThese = ['username' => $request->username, 'password' => $request->password];

        $user = User::where($matchThese)->first();
        $tech = Tech::where($matchThese)->first();
        $admin = Admin::where($matchThese)->first();

        if ($user) {
            return $user;
        }

        if ($tech) {
            return $tech;
        }
        
        if ($admin) {
            return $admin;
        }

        return abort(404, 'User not found');
    }

    public function destroy($id)
    {
        //
    }
}
