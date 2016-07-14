<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::paginate(15);

        return view('member.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('member.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'author' => 'required', 'isbn' => 'required', 'shelflocation' => 'required', ]);

        Post::create($request->all());

        Session::flash('flash_message', 'Post added!');

        return redirect('member/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('member.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('member.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['title' => 'required', 'author' => 'required', 'isbn' => 'required', 'shelflocation' => 'required', ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        Session::flash('flash_message', 'Post updated!');

        return redirect('member/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('member/posts');
    }
}
