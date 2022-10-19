<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $user = Post::latest()->get();
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

    public function storePost(Request $request) {
        //dd($request->input());
        $lastPostId = 0;

        if (Post::latest()->first()) {
            $posts = Post::latest()->first();
            $lastPostId = $posts->id;
        }

        $fileName = $_FILES["file"]["name"];
        $fileTempName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];

        if ($fileSize < 1000000) {
            $newFileName = $lastPostId + 1 . "_" . $fileName;
            $fileDestinationPath = $_SERVER['DOCUMENT_ROOT'] . "/images/uploads/" . $newFileName;
            move_uploaded_file($fileTempName, $fileDestinationPath);
            Post::create([
                "img" => $newFileName,
                "time" => date("Y-m-d"),
                "userId" => $request->input('userId')
            ]);
        }

        //dd($file);
    }
}
