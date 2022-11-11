<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke() // Este método se llama automáticamente, es como un constructor
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray(); // pluck trae solo el valor que necesitamos, toarray lo convierte a array
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20); // los posts que contengan los ids del array
        
        return view('home', [
            'posts' => $posts
        ] );
    }
}
