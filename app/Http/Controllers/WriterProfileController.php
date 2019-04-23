<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WriterProfile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Carbon\Carbon;

class WriterProfileController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WriterProfile $writer)
    {
		$totalArticles = $writer->post->count();
		$publishedArticles = $writer->post()->published()->count();
		
		// Create and Resize the default image
		Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');

        return view('writer.show', compact('writer', 'defaultImg', 'totalArticles', 'publishedArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WriterProfile $writer)
    {
        // Create and Resize the default image
		Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');
		
        return view('writer.edit', compact('writer', 'defaultImg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WriterProfile $writer)
    {
        $writer->firstname = $request->firstname;
        $writer->lastname = $request->lastname;
        $writer->about = $request->about;
        $writer->fb = $request->fb;
        $writer->twitter = $request->twitter;
        $writer->instagram = $request->instagram;
		
		if($writer->save()) {
			return redirect()->action('WriterProfileController@edit', ['writer' => $writer])->with('status', 'Profile Updated Successfully');
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
        //
    }
}
