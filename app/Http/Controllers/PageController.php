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
        $posts = Post::latest()->with('user');

        if ($request->get('my-posts')) {
            $posts->where('user_id', $request->user()->id);
        }

        return Inertia::render('Dashboard', [
            'posts' => $posts->get(),
            'filter' => $request->get('my-posts') ? 'my' : 'all',
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
