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
        $hash = crypt($request->password, $request->username);
        $matchThese = ['username' => $request->username, 'password' => $hash ];

        $user = User::where($matchThese)->first();

        if ($user) {
            return $user;
        }

        return false;
    }

    public function destroy($id)
    {
        //
    }
}
