<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::all();
        return $this-> returnData('comments', $comment);
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
            'userComment' => 'required',
            'user_id' => ''
        ]);
        $newComment = new Comment([
            'userComment' => $request->get('userComment'),
            'user_id' => $request->get('user_id')
        ]);
        $newComment->save();
        return $this-> returnData('comment', $newComment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return $this-> returnData('comment', $comment);
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
        $comment = Comment::findOrFail($id);
        $request->validate([
            'userComment' => '',
            'user_id' => ''
        ]);
        $comment->question = $request->get('userComment');
        $comment->choiceA = $request->get('user_id');
        $comment->save();
        return $this-> returnData('comment', $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return $this-> returnData('comments', $comment::all());
    }
}
