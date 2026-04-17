<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Inertia\Inertia;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->get('my-posts')) {
            $user = $request->user();
            // $post = Post::where('user_id', $request->user()->id)->latest()->with('user')->get();

            // $friends_from_ids = $user->friendsFrom()->pluck('users.id');
            // $friends_to_ids = $user->friendsTo()->pluck('users.id');
            $users_ids = $user->friends()->pluck('id')->push($user->id);

            // $post = $user->posts()->latest()->with('user')->get();
            $post = Post::whereIn('user_id', $users_ids)->latest()->with('user')->get();
        } else {
            $post = Post::latest()->with('user')->get();
        }

        return Inertia::render('Dashboard', [
            'posts' => $post
        ]);
    }

    public function profile(User $user)
    {
        $posts = $user->posts()->latest()->with('user')->get();
        return Inertia::render('Profile', [
            'posts' => $posts
        ]);
    }

    public function status(Request $request)
    {
        $sent = $request->user()->pendingFrom;
        $received = $request->user()->pendingTo;
        //get Friends

        return Inertia::render('Status', [
            'sent' => $sent,
            'received' => $received,
        ]);
    }
}
