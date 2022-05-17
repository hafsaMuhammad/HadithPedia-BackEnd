<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadiths = Hadith::all();
        return $this-> returnData('hadiths', $hadiths);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sanad' => 'required',
            'matn' => 'required',
            'description' => '',
            'source' => '',
            'degree' => '',
            'cluster_id' => ''

        ]);


        $newHadith = new Hadith([
            'sanad' => $request->get('sanad'),
            'matn' => $request->get('matn'),
            'description' => $request->get('description'),
            'source' => $request->get('source'),
            'degree' => $request->get('degree'),
            'cluster_id' => $request->get('cluster_id')
        ]);

        $newHadith->save();

        return $this-> returnData('hadith', $newHadith);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hadith = Hadith::findOrFail($id);
        return $this-> returnData('hadith', $hadith);
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
        $hadith = Hadith::findOrFail($id);


        $request->validate([
            'sanad' => '',
            'matn' => '',
            'description' => '',
            'source' => '',
            'degree' => '',
            'cluster_id' => ''

        ]);

        $hadith->matn = $request->get('matn');
        $hadith->sanad = $request->get('sanad');
        $hadith->description = $request->get('description');
        $hadith->source = $request->get('source');
        $hadith->degree = $request->get('degree');
        $hadith->cluster_id = $request->get('cluster_id');

        $hadith->save();
        return $this-> returnData('hadith', $hadith);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hadith = Hadith::findOrFail($id);
        $hadith->delete();
        return $this-> returnData('hadiths', $hadith::all());
    }
}
