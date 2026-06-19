<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog index page.
     */
    public function index()
    {
        return view('blog.index');
    }

    /**
     * Display a specific blog post by slug.
     */
    public function show($slug)
    {
        $view = 'blog.' . $slug;
        if (view()->exists($view)) {
            return view($view);
        }
        abort(404);
    }
}
