<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    
public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $post = Post::all()->where('id',$comment->post_id)->first();
        $comment->delete();
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

}