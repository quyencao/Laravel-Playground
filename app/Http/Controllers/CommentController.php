<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $rootComments = $this->loadComment(0);

//        return $rootComments;

        return view('comments', compact('rootComments'));
    }

    public function loadComment($id) {
        $rootComments = Comment::where('parent_id', $id)->get();

        foreach ($rootComments as $comment) {
            $comment->comments = $this->loadComment($comment->id);
        }

        return $rootComments;
    }

    public function add(Request $request) {
        Comment::create([
           'parent_id' => $request->parent_id,
           'comment' => $request->comment,
           'username' => 'Quyen'
        ]);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
