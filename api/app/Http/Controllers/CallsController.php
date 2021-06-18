<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Call as Call;
use App\Models\User as User;

class CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = DB::table('users')
            ->join('calls', 'users.id', '=', 'calls.user_id')
            ->get();
        
        return $calls;

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
        $newCall = new Call;
        $newCall->title = $request->title;
        $newCall->description = $request->description;
        $newCall->filepath = $request->filepath;
        $newCall->severity = $request->severity;
        $newCall->user_id = $request->user_id;
        $newCall->save();
        
        return $newCall;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $existingCall = Call::find($id);

        return $existingCall;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        return Call::where('user_id', $id)->get();
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
        $existingCall = Call::find($id);

        if ($existingCall){
            $existingCall->title = $request->title;
            $existingCall->description = $request->description;
            $existingCall->filepath = $request->filepath;
            $existingCall->status = $request->status;
            $existingCall->severity = $request->severity;
            $existingCall->urgency = $request->urgency;
            $existingCall->trend = $request->trend;
            $existingCall->gut = $request->gut;
            $existingCall->user_id = $request->user_id;
            $existingCall->technician_id = $request->technician_id;
            $existingCall->save();
        }
        
        
        return $existingCall;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingCall = Call::find($id);

        if ($existingCall){
            $existingCall->delete();
            return "User successfully deleted.";
        }

        return "Call not Found";
    }
}
