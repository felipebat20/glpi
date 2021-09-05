<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician as Tech;
use App\Models\Users as User;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $techs = User::where('usertype', 2)->get();
        return $techs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTech = new Tech;
        $newTech->name = $request->name;
        $newTech->password = $request->password;
        $newTech->username = $request->username;
        $newTech->save();

        return $newTech;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matchThese = ['id' => $id, 'usertype' => 2];

        $existingTech = User::find($matchThese);

        if ($existingTech){
            return $existingTech;
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingTech = Tech::find($id);

        if ($existingTech){
            $existingTech->delete();
            return "User successfully deleted.";
        }

        return "User not Found";
    }
}
