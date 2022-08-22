<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index() {
//        $posts = Post::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))
//            ->pluck('count', 'month_name');
//
//        $labels = $users->keys();
//        $data = $users->values();
        return view('dashboard', ['posts' => Post::get()]);
    }

    public function show($id) {         // associative array
        return view('pages.show', [
            'id' => $id,
            'name' => 'Saac'
        ]);
    }
}
