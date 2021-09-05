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
        $matchThese = ['username' => $request->username, 'password' => bcrypt($request->password, $request->username)];

        $user = User::where($matchThese)->first();


        if ($user) {
            return $user;
        }

        $user = User::where('username', $request->username);
        if($user = $user->usertype === 3)
            return $user;

        return abort(404, 'User not found');
    }

    public function destroy($id)
    {
        //
    }
}
