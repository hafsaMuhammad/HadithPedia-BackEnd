<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use App\Models\HadithQuestion;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class HadithQuestionController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadithQuestions = HadithQuestion::all();
        return $this-> returnData('hadithQuestions', $hadithQuestions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'choiceA' => 'required',
            'choiceB' => 'required',
            'choiceC' => '',
            'correct' => 'required',
            'hadith_id' => '',

        ]);


        $newHadithQuestion = new HadithQuestion([
            'question' => $request->get('question'),
            'choiceA' => $request->get('choiceA'),
            'choiceB' => $request->get('choiceB'),
            'choiceC' => $request->get('choiceC'),
            'correct' => $request->get('correct'),
            'hadith_id' => $request->get('hadith_id')
        ]);

        $newHadithQuestion->save();

        return $this-> returnData('hadithQuestion', $newHadithQuestion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hadithQuestion = HadithQuestion::findOrFail($id);
        return $this-> returnData('hadithQuestion', $hadithQuestion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hadithQuestion = HadithQuestion::findOrFail($id);


        $request->validate([
            'question' => '',
            'choiceA' => '',
            'choiceB' => '',
            'choiceC' => '',
            'correct' => '',
            'hadith_id' => '',

        ]);

        $hadithQuestion->question = $request->get('question');
        $hadithQuestion->choiceA = $request->get('choiceA');
        $hadithQuestion->choiceB = $request->get('choiceB');
        $hadithQuestion->choiceC = $request->get('choiceC');
        $hadithQuestion->correct = $request->get('correct');
        $hadithQuestion->hadith_id = $request->get('hadith_id');

        $hadithQuestion->save();
        return $this-> returnData('hadithQuestion', $hadithQuestion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hadithQuestion = HadithQuestion::findOrFail($id);
        $hadithQuestion->delete();

        return $this-> returnData('hadithQuestion', $hadithQuestion::all());
    }


    public function insertLevel(){
        $hadiths = Hadith::all();
        foreach($hadiths as $hadith){
            $hadithsQuestion = $hadith->hadithQuestion;
            $levelId = $hadith->level_id;
            if ($hadith->id != null) {
                $hadithsQuestion->level_id = $levelId;
            }
            $hadithsQuestion->save();
        }
        return 'ok';
    }
}
