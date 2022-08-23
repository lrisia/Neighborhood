<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $this->authorize('view', Auth::user(), User::class);

        $label = [];
        $label2 = [];
        $price = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $tags = Tag::get();
        foreach ($tags as $tag) {
            array_push($label, $tag->name);
            array_push($price, $tag->posts->count());
            array_push($data2, $tag->posts->where('organization_id', '1')->count());
            array_push($data3, $tag->posts->where('organization_id', '2')->count());
            array_push($data4, $tag->posts->where('organization_id', '3')->count());
            array_push($data5, $tag->posts->where('organization_id', '4')->count());
        }
        $organizations = Organization::get();
        $posts = Post::get();
        foreach ($organizations as $organization) {
            array_push($label2, $organization->name);
            array_push($data6, $posts->where('organization_id', $organization->id)
                                            ->where('create_at', '<=', Carbon::today()->startOfMonth()->toDateString())
                                            ->where('create_at', '<=', Carbon::today()->endOfMonth()->toDateString())
                                            ->count()
            );
        }
//        dd($label[0]); // -> น้ำท่วม
//        dd($data6);
        return view('dashboard', ['labels1' => $label,
                                        'labels2' => $label2,
                                        'data1' => $price,
                                        'data2' => $data2,
                                        'data3' => $data3,
                                        'data4' => $data4,
                                        'data5' => $data5,
                                        'data6' => $data6]);
//        $posts = Post::all()->where('like_count','>=','49555');
//        $tags_array = [];
//        foreach ($posts as $post) {
//            foreach($post->tags as $tag){
//                $tags_array[] = $tag->name;
//            }
//        }
//        $tags_array = array_unique($tags_array);
//        $tags_number = array_map(function ($tag_array) use ($posts) {
//            $number = 0;
//            foreach($posts as $post) {
//                foreach($post->tags as $tag) {
//                    if ( $tag->name == $tag_array) {
//                        $number = $number + 1;
//                    }
//                }
//            }
//            return $number;
//        }, $tags_array);
//        $tags = array_combine($tags_array, $tags_number);
//        arsort($tags);
//        $tag_mosttag = 5;
//        $tags = array_slice($tags, 0, $tag_mosttag, true);
//        $tags_array = array_keys($tags);
//        $tags_number = array_values($tags);
//        return view('dashboard',
//                ['tags_array' => $tags_array,
//                'tags_number' => $tags_number]);

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
