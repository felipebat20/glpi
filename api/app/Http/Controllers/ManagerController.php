<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager as Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Call as Call;
use App\Models\User as User;


class ManagerController extends Controller
{
    public function index()
    {
        return Admin::orderBy('created_at', 'DESC')->get();
    }

    public function calls()
    {
        return Call::all();
    }


    public function store(Request $request)
    {
        $newAdmin = new Admin;
        $newAdmin->name = $request->name;
        $newAdmin->password = $request->password;
        $newAdmin->username = $request->username;
        $newAdmin->save();

        return $newAdmin;
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $existingAdmin = Admin::find($id);

        if ($existingAdmin){
           $existingAdmin->name = $request->name;
           $existingAdmin->password = $request->password;
           $existingAdmin->username = $request->username;
           $existingAdmin->save();

           return $existingAdmin;
        }
    }

    public function destroy($id)
    {
        $existingAdmin = Admin::find($id);

        if ($existingAdmin){
            $existingAdmin->delete();
            return "User successfully deleted.";
        }

        return "Call not Found";
    }
}
