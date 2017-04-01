<?php

namespace Yk\LaravelBlogs\App\Http\Controllers;

use Illuminate\Http\Request;

use Yk\LaravelBlogs\App\Blog;
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
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);

        return view('Yk\LaravelBlogs::blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Yk\LaravelBlogs::blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:191',
            'body' => 'required|min:150',
        ]);

        if ($validator->fails()) {
            if($request->ajax())
            {
                return Response::json($validator->messages(), 400);
            }else{
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
        }

        $blog = new Blog;
        $blog->title = $request->get('title');
        $blog->body = $request->get('body');

        $blog->save();

        return redirect(route('blogs.index'));
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

        return view('Yk\LaravelBlogs::blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('Yk\LaravelBlogs::blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:191',
            'body' => 'required|min:150',
        ]);

        if ($validator->fails()) {
            if($request->ajax())
            {
                return Response::json($validator->messages(), 400);
            }else{
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
        }

        $blog->title = $request->get('title');
        $blog->body = $request->get('body');

        $blog->save();

        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return redirect(route('blogs.index'));
    }
}
