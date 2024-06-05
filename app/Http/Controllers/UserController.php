<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('user.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $editting = true;
        $ideas = $user->ideas()->paginate(5);

        return view('user.edit', compact('user', 'editting', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validate = $request->validate();

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validate['image'] = $imagePath;

            Storage::disk('public')->delete($user->image);
        }

        $user->update($validate);

        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function profile(User $user)
    {
        return $this->show(auth()->user());
    }
}
