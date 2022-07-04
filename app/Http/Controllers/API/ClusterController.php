<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\Level;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use SebastianBergmann\LinesOfCode\Counter;

class ClusterController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusters = Cluster::all();
        return $this-> returnData('clusters', $clusters);
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
        ]);
        $newCluster = new Cluster([
            'name' => $request->get('name'),
        ]);
        $newCluster->save();
        return $this-> returnData('cluster', $newCluster);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cluster = Cluster::findOrFail($id);
        return $this-> returnData('cluster', $cluster);
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
        $cluster = Cluster::findOrFail($id);
        $request->validate([
            'name' => '',
        ]);
        $cluster->name = $request->get('name');
        $cluster->save();
        return $this-> returnData('cluster', $cluster);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cluster = Cluster::findOrFail($id);
        $cluster->delete();
        return $this-> returnData('clusters', $cluster::all());
    }


    //get hadiths of a specific cluster

    //get all hadiths that is attached to a cluster
     public function clusterHadiths($id){
        $cluster =  Cluster::findOrFail($id);
        $clusterHadiths = $cluster->hadiths;
        return $this->returnData('clusterHadiths', $clusterHadiths);
    }





    /*function to take the response of the cluter hadiths
      and insert hadiths or attach it it into new levels
     */
    public function insertData()
    {
        for ($k=1; $k <3 ; $k++) { 
            $cluster = Cluster::findOrFail($k);
            $hadiths = $cluster->hadiths;
            $length =  count($hadiths);
            $eq = ($length/10) + 1;
            for ($j=1; $j <= $eq; $j++) 
                { 
                    $newlevel = Level::create([
                        'name'=> 'level'.$j,
                        'cluster_id' => $k
                    ]);
                    $count = $j-1;
                    for ($i = ($count * 10) ; $i < $length ; $i++) { 
                            $hadith = $hadiths[$i];
                            $hadith->level_id = $newlevel->id;
                            $hadith->save();
                    }
            }
        }
        return 'ok';
    }
}