<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RecCenter;

class RecCenterController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	    $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$recs = RecCenter::all();

	    return view('admin.recs.index', compact('recs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    // Validate incoming data
	    $this->validate($request, [
		    'name'            => 'required|max:50',
		    'nickname'        => 'nullable|max:50',
		    'owner'           => 'nullable|max:50',
		    'address'         => 'required|max:50',
		    'recs_phone'      => 'numeric|nullable|digits_between:10,15',
		    'indoor'          => 'numeric|nullable',
		    'outdoor'         => 'numeric|nullable',
		    'additional_info' => 'nullable',
	    ]);

	    $rec = new RecCenter();

	    foreach($request->all() as $key => $req) {
	    	if($key != '_token') {
			    $rec->$key = $req;
		    }
	    }

	    if($rec->save()) {
	    	return redirect()->action('\RecCenterController@index')->with('status', 'New Rec Center Saved Successfully');
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RecCenter $rec)
    {
        // dd($rec_center);
		return view('recs.show', compact('rec_center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $rec
     * @return \Illuminate\Http\Response
     */
    public function edit(RecCenter $rec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $rec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecCenter $rec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecCenter $rec)
    {
        //
    }

}
