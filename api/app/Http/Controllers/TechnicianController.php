<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use App\Models\Technician as Tech;
use App\Models\User as User;

class TechnicianController extends Controller
{
    public function index()
    {
        $techs = User::where('user_type', 2)->get();
        return $techs;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $newTech = new Tech;
        $newTech->name = $request->name;
        $newTech->password = $request->password;
        $newTech->username = $request->username;
        $newTech->save();

        return $newTech;
    }

    public function show($id)
    {
        $matchThese = ['id' => $id, 'usertype' => 2];

        $existingTech = User::find($matchThese);

        if ($existingTech){
            return $existingTech;
        }

        return abort(404);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $existingTech = Tech::find($id);

        if ($existingTech){
           $existingTech->name = $request->name;
           $existingTech->password = $request->password;
           $existingTech->username = $request->username;
           $existingTech->save();

           return $existingTech;
        }

    }

    public function destroy($id)
    {
        $existingTech = Tech::find($id);

        if ($existingTech){
            $existingTech->delete();
            return "User successfully deleted.";
        }

        return "User not Found";
    }

    public function calls($id)
    {
        return Call::all()->where('technician_id', $id);
    }
}
