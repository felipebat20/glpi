<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallAction as Action;

class ActionController extends Controller
{
    public function index()
    {   
        return Action::orderBy('created_at', 'DESC')->get();

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
}
