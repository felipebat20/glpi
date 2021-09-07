<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('usertype', '<>', 3)->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $newUser = new User;
        $newUser->name = $request->name;
        $newUser->password = crypt($request->password, $request->username);
        $newUser->username = $request->username;
        $newUser->usertype = $request->usertype;
        $newUser->save();

        return $newUser;
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        $existingUser = User::find($id);

        if ($existingUser){
           $existingUser->name = $request->name;
           $existingUser->password = $request->password;
           $existingUser->username = $request->username;
           $existingUser->save();

           return $existingUser;
        }

        return abort(404, 'User not found.');
    }

    public function destroy($id)
    {
        $existingUser = User::find($id);

        if ( $existingUser ){
            $existingUser->delete();
            return "User successfully deleted.";
        }

        return "User not Found";
    }
}
