<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index() {
        
              
        $posts = Post::all()->where('like_count','>=','49555');

        


        $tags_array = [];
        foreach ($posts as $post) {
            foreach($post->tags as $tag){
                $tags_array[] = $tag->name;
            }
        }

        $tags_array = array_unique($tags_array);



        $tags_number = array_map(function ($tag_array) use ($posts) {
            $number = 0;
            foreach($posts as $post) { 
                foreach($post->tags as $tag) { 
                    if ( $tag->name == $tag_array) { 
                        $number = $number + 1;
                    }
                }
            }
            return $number;
        }, $tags_array);
        

        $tags = array_combine($tags_array, $tags_number);
        arsort($tags);

        
    

        $tag_mosttag = 5;
        $tags = array_slice($tags, 0, $tag_mosttag, true);


        $tags_array = array_keys($tags);
        $tags_number = array_values($tags);

    

        return view('dashboard',
                ['tags_array' => $tags_array,
                'tags_number' => $tags_number]);


//        $posts = Post::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))
//            ->pluck('count', 'month_name');
//
//        $labels = $users->keys();
//        $data = $users->values();
    }

    public function show($id) {         // associative array
        return view('pages.show', [
            'id' => $id,
            'name' => 'Saac'
        ]);
    }
}
