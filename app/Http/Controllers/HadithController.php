<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hadith;

class HadithController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadiths = Hadith::all();
        return view('Hadith.hadiths',compact('hadiths'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Hadith.addhadith');
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
            'sanad' => 'required',
            'matn' => 'required',
            'description' => 'required',
            'source' => 'required',
            'degree' => 'required',
            'cluster_id' => '',
        ]);
        Hadith::create([
            'sanad'=> $request->sanad,
            'matn'=> $request->matn,
            'description'=>$request->description,
            'source'=> $request->source,
            'degree'=> $request->degree,
            'cluster_id'=> $request->cluster_id
        ]);
        return redirect()->back()->with('msg','تم إضفة حديث جديد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hadith = Hadith::findOrFail($id);
        return view('Hadith.editHadith', compact('hadith'));
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
        return redirect()->back()->with('msg','تم تعديل الحديث');
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
