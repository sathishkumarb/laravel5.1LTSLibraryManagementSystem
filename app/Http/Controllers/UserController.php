<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $books = Book::paginate(15);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', 'password_confirmation' => 'required', ]);

        Book::create($request->all());

        Session::flash('flash_message', 'User added!');

        return redirect('users');
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
        $Book = Book::findOrFail($id);

        return view('users.show', compact('User'));
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
        $Book = Book::findOrFail($id);

        return view('users.edit', compact('User'));
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
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', 'password_confirmation' => 'required', ]);

        $Book = Book::findOrFail($id);
        $Book->update($request->all());

        Session::flash('flash_message', 'User updated!');

        return redirect('users');
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
        Book::destroy($id);

        Session::flash('flash_message', 'user deleted!');

        return redirect('users');
    }
}
