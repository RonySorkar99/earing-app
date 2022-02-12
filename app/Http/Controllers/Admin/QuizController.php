<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Options;

class QuizController extends Controller
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
        return view('Admin.add-quz');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $ques = Question::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'note' => $request->note,
            'coin' => $request->coin,
            // 'option' => $request->option,
        ]);

        if (count($request->option) > 0) {
            foreach ($request->option as $v) {
                $datad = array(
                    'questions_id' => $ques->id,
                    'option' => $v,
                );
                Options::insert($datad);
            }
        }


        return redirect()->back()->with('success', 'Data add successfully');
    }





    //     $data = new Question();
    //     $data->question =$request->question;
    //     $data->option = $request->option[];
    //     $data->answer=$request->answer;
    //     $data->note=$request->note;
    //     $data->coin=$request->coin;
    //     $data->save();
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
