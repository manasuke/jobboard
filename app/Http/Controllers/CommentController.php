<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request, Idea $idea)
    {
        $validate = $request->validate();

        $validate['user_id'] = auth()->id();
        $validate['idea_id'] = $idea->id;

        Comment::create($validate);

        return redirect()
            ->route('idea.show', $idea->id)
            ->with('success', 'Comment posted successfully');
    }
}
