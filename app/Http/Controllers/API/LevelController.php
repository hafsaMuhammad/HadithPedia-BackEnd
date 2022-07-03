<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        return $this-> returnData('levels', $levels);
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
            'name' => 'required',
            'cluster_id' => '',
        ]);
        $newLevel = new Level([
            'name' => $request->get('name'),
            'cluster_id' => $request->get('cluster_id'),
        ]);
        $newLevel->save();
        return $this-> returnData('level', $newLevel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::findOrFail($id);
        return $this-> returnData('level', $level);
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
        $level = Level::findOrFail($id);
        $request->validate([
            'name' => '',
            'cluster_id' => '',
        ]);
        $level->name = $request->get('name');
        $level->cluster_id = $request->get('cluster_id');
        $level->save();
        return $this-> returnData('level', $level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return $this-> returnData('levels', $level::all());
    }


    //get all hadiths that is attached to a level
    public function levelHadiths($id){
        $level =  Level::findOrFail($id);
        $levelHadiths = $level->hadiths;
        return $this->returnData('levelHadiths', $levelHadiths);
    }
}
