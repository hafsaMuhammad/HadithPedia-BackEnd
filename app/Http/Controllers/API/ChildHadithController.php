<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChildHadith;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ChildHadithController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childhadiths = ChildHadith::all();
        return $this-> returnData('childhadiths', $childhadiths);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     
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
            'matn' => 'required',
            'description' => '',
            'image' => '',
            'iamgePath' => '',
            'audio' => '',
            'audioPath' => ''

        ]);


        $newChildhadith = new ChildHadith([
            'matn' => $request->get('matn'),
            'description' => $request->get('description'),
            'image' => $request->get('image'),
            'iamgePath' => $request->get('iamgePath'),
            'audio' => $request->get('audio'),
            'audioPath' => $request->get('audioPath')
        ]);

        // $image= uploadImage('hadithImages', $request->iamgePath);
        // $newChildhadith->image=$image;
        // $newChildhadith->iamgePath = $newChildhadith->getPhotoAttribute($image);

        // $audio = uploadAudio('hadithAudio', $request->audioPath);
        // $newChildhadith->audio= $audio;
        // $newChildhadith->audioPath= $newChildhadith->getAudioAttribute($audio);

        $newChildhadith->save();
        return $this-> returnData('childhadith', $newChildhadith);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $childhadith = ChildHadith::findOrFail($id);
        return $this-> returnData('childhadith', $childhadith);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     
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
        $childhadith = ChildHadith::findOrFail($id);


        $request->validate([
            'matn' => '',
            'description' => '',
            'image' => '',
            'iamgePath' => '',
            'audio' => '',
            'audioPath' => ''

        ]);

        $childhadith->matn = $request->get('matn');
        $childhadith->description = $request->get('description');
        $childhadith->image = $request->get('image');
        $childhadith->iamgePath = $request->get('iamgePath');
        $childhadith->audio = $request->get('audio');
        $childhadith->audioPath = $request->get('audioPath');

        $image= uploadImage('hadithImages', $childhadith->iamgePath);
        $childhadith->image=$image;
        $childhadith->iamgePath = $childhadith->getPhotoAttribute($image);

        $audio = uploadAudio('hadithAudio', $childhadith->audioPath);
        $childhadith->audio= $audio;
        $childhadith->audioPath= $childhadith->getAudioAttribute($audio);

        $childhadith->save();
        return $this-> returnData('childhadith', $childhadith);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childhadith = ChildHadith::findOrFail($id);
        $childhadith->delete();
        return $this-> returnData('childhadiths', $childhadith::all());
    }

    public function truncate()
    {
        ChildHadith::truncate();
        return $this-> returnData('childhadiths', ChildHadith::all());
    }

    public function getImages()
    {
        $images=ChildHadith::all('iamgePath');
        return $this-> returnData('images',$images );
    }
}
