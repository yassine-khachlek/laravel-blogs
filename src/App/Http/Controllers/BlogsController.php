<?php

namespace Yk\LaravelBlogs\App\Http\Controllers;

use Illuminate\Http\Request;

use Yk\LaravelBlogs\App\Blog;
use Yk\LaravelBlogs\App\BlogTranslation;
use Config;
use DB;
use Validator;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::wherePublished(true)->orderBy('id', 'desc')->paginate(10);

        return view('Yk\LaravelBlogs::frontend.blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('Yk\LaravelBlogs::frontend.blogs.show', compact('blog'));
    }
}
