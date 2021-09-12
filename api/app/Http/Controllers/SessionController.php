<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;

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
