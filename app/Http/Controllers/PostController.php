<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
   public function index() {
      $posts = DB::table('posts')->get();
    return view('posts.index', compact('posts'));
   }

   public function show($id) {
      $posts = Post::find($id);

      return view('posts.show', compact('posts'));
   }

   public function create() {
      return view('posts.create');
   }

   public function store(Request $request) {
      $request->validate([
         'title' => 'required|max:20',
         'content' => 'required|max:200'
      ]);

      $posts = new Post();
      $posts->title = $request->input('title');
      $posts->content = $request->input('content');
      $posts->save();

      return redirect("/posts");
   }
}
