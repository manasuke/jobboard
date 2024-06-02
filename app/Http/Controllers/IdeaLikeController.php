<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea)
    {
        $liker = auth()->user();
        // dd($liker);
        $liker->likes()->attach($idea);

        return to_route('dashboard')->with('success', 'Liked successfully');
    }

    public function unlike(Idea $idea)
    {
        $liker = auth()->user();
        $liker->likes()->dettach($idea);

        return to_route('dashboard')->with('success', 'Unliked successfully');
    }
}
