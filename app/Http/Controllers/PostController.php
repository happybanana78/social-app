<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $user = Post::all();
        return $user;
    }

    public function like(Request $request) {

        $post = Post::find($request->input('uId'));

        $likeArray = $request->input('likes');
        $dbLikes = explode(",", $post->like);

        //dd($dbLikes);

        if (!in_array($request->input('uId'), $dbLikes)) {
            $post->like = implode(',', $likeArray);
            $post->update();
        }
    }

    public function getComments($id) {
        $comments = Comment::where('postId', $id)->get();

        return response()->json($comments);
    }

    public function storeComment(Request $request) {
        //dd($request->input());
        Comment::create([
            "userId" => $request->input('userId'),
            "postId" => $request->input('postId'),
            "text" => $request->input('text')
        ]);
    }
}
