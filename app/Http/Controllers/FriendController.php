<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user)
    {
        // TOODO: Check if user is already friends
        // use method isRelated

        $request->user()->from()->attach($user);

        return back();
    }

    public function update(Request $request, User $user)
    {
        // $request->user()->pendingTo()->where('from_id', $user->id)->updated(['accepted' => true]);
        $request->user()->pendingTo()->updateExistingPivot($user, ['accepted' => true]);

        return back();
    }
}
