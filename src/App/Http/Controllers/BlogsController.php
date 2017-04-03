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
        $data = [];
        $rules = [];

        foreach (Config::get('yk.laravel-blogs.languages') as $language_key => $language) {

            $data['title_'.$language_key] = $request->get('title_'.$language_key);
            $data['body_'.$language_key] = $request->get('body_'.$language_key);
            $data['published_'.$language_key] = $request->get('published_'.$language_key) ?: false;

            if ($request->get('published_'.$language_key)) {
                $rules['title_'.$language_key] = 'required|min:3|max:191';
                $rules['body_'.$language_key] = 'required|min:150';
            }

        }

        $validator = Validator::make($data, $rules);

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

        DB::transaction(function () use ($request) {

            $blog = new Blog;
            $blog->published = $request->get('published') ?: false;
            $blog->save();

            $translations = [];

            foreach (Config::get('yk.laravel-blogs.languages') as $language_key => $language) {
                
                $translation = new BlogTranslation;
                $translation->language_code = $language_key;
                $translation->title = $request->get('title_'.$language_key);
                $translation->body = $request->get('body_'.$language_key);
                $translation->published = $request->get('published_'.$language_key) ?: false;
                
                $translations[] = $translation;
            }

            $blog->translations()->saveMany($translations);

        });

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

        $data = [];
        $rules = [];

        foreach (Config::get('yk.laravel-blogs.languages') as $language_key => $language) {

            $data['title_'.$language_key] = $request->get('title_'.$language_key);
            $data['body_'.$language_key] = $request->get('body_'.$language_key);
            $data['published_'.$language_key] = $request->get('published_'.$language_key) ?: false;

            if ($request->get('published_'.$language_key)) {
                $rules['title_'.$language_key] = 'required|min:3|max:191';
                $rules['body_'.$language_key] = 'required|min:150';
            }

        }

        $validator = Validator::make($data, $rules);

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

        DB::transaction(function () use ($request, $blog) {

            $blog->published = $request->get('published') ?: false;
            $blog->save();

            $translations = [];

            foreach (Config::get('yk.laravel-blogs.languages') as $language_key => $language) {
                
                $translation = BlogTranslation::where(['blog_id' => $blog->id, 'language_code' => $language_key])->first() ?: new BlogTranslation;
                $translation->language_code = $language_key;
                $translation->title = $request->get('title_'.$language_key);
                $translation->body = $request->get('body_'.$language_key);
                $translation->published = $request->get('published_'.$language_key) ?: false;
                
                $translations[] = $translation;
            }

            $blog->translations()->saveMany($translations);

        });

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
