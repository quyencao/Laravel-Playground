<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        return view('comments');
    }

    public function loadComment($id) {
        $rootComments = Comment::where('parent_id', $id)->latest()->get();

        foreach ($rootComments as $comment) {
            $comment->comments = $this->loadComment($comment->id);
        }

        return $rootComments;
    }

    public function add(Request $request) {
        $comment = Comment::create([
           'parent_id' => $request->parent_id,
           'comment' => $request->comment,
           'username' => 'Quyen'
        ]);

        return response()->json([
            'status' => 'OK',
            'comment' => $comment
        ]);
    }

    public function getComments() {
        return response()->json($this->loadComment(0));
    }
}
