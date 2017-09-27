<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;

class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ideas');
    }

    public function listByOffset($offset)
    {
        return Idea::listByOffset($offset);
    }

    public function ideaCount()
    {
        return Idea::ideaCount();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newidea');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());
        $idea = new Idea;

        $idea->idea = request('idea');
        $idea->user_id = 1;
        $idea->ip_address = $_SERVER['REMOTE_ADDR'];

        // Check if idea save was successfull
        if (!$idea->save()) {
            abort(500, 'Error');
        }

        //User got saved show OK message
        return ['success' => true, 'idea' => $idea->idea];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
