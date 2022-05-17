<?php

namespace App\Http\Controllers;

use App\Models\HadithQuestion;
use Illuminate\Http\Request;

class HadithQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadithQuestions = HadithQuestion::all();
        return view('HadithQuestion.Question',compact('hadithQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('HadithQuestion.addQuestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'choiceA' => 'required',
            'choiceB' => 'required',
            'choiceC' => '',
            'correct' => 'required',
            'hadith_id' => ''
        ]);
        HadithQuestion::create([
            'question'=> $request->question,
            'choiceA'=> $request->choiceA,
            'choiceB'=>$request->choiceB,
            'choiceC'=> $request->choiceC,
            'correct'=> $request->correct,
            'hadith_id' => $request->hadith_id
        ]);
        return redirect()->back()->with('msg','تم إضفة سؤال جديد');
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
