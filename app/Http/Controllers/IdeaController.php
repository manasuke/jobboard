<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Models\Idea;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }
    public function store(CreateIdeaRequest $request)
    {
        $validate = $request->validate();

        $validate['user_id'] = auth()->id();

        Idea::create($validate);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        // if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }
        //($id)
        // Idea::where('id', $id)->firstOrFail()->delete();
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);
        // if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }

        $editting = true;
        return view('ideas.show', compact('idea', 'editting'));
    }

    public function update(CreateIdeaRequest $request, Idea $idea)
    {
        $this->authorize('update', $idea);
        // if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }

        $validate = $request->validate();

        $idea->update($validate);

        return redirect()
            ->route('idea.show', $idea->id)
            ->with('success', 'Idea updated successfully');
    }
}
