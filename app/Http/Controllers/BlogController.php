<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $allPosts = $query->latest('published_at')->get();
        
        $featured = $allPosts->first();
        
        // Paginate the rest (excluding the featured one if it exists)
        $postsQuery = BlogPost::query();
        if ($featured) {
            $postsQuery->where('id', '!=', $featured->id);
        }
        
        if ($request->has('search') && $request->search != '') {
            $postsQuery->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->has('category') && $request->category != '') {
            $postsQuery->where('category', $request->category);
        }

        $posts = $postsQuery->latest('published_at')->paginate(9)->appends($request->query());

        $categories = BlogPost::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('blog.index', compact('featured', 'posts', 'categories'));
    }

    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        
        $related = BlogPost::where('category', $post->category)
                           ->where('id', '!=', $post->id)
                           ->latest('published_at')
                           ->take(3)
                           ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
