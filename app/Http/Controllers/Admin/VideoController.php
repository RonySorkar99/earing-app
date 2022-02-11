<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
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
      return view('Admin.add-video');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'video_coin' => 'required',
            'web_link' => 'max:1000',
            'video' => 'mimes:mp4, mp3, ogx, oga, ogg,webm',
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif,svg',
         ]);


              $insert=new Video();

              $file=$request->file('video');
              $file->move('upload/video', $file->getClientOriginalName());
              $file_name=$file->getClientOriginalName();

              $insert->video = $file_name;
              $insert->video_coin = $request -> video_coin;
              $insert->web_link = $request -> web_link;

              if ($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = time(). '.'.$extension;
                $file->move('upload/thumbnail',$filename);
                $insert['thumbnail']=$filename;
            }else{
                return $request;
                $insert->image = '';
            }
              $insert-> save();
              return redirect()->back()->with("video-posted", "Video Post successfull");


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
