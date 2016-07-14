<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $books = Book::paginate(15);

        return view('member.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('member.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'author' => 'required', 'isbn' => 'required', 'shelflocation' => 'required', ]);

        Book::create($request->all());

        Session::flash('flash_message', 'Book added!');

        return redirect('member/books');
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

        return view('member.books.show', compact('Book'));
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

        return view('member.books.edit', compact('Book'));
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

        $Book = Book::findOrFail($id);
        $Book->update($request->all());

        Session::flash('flash_message', 'Book updated!');

        return redirect('member/books');
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

        Session::flash('flash_message', 'Book deleted!');

        return redirect('member/books');
    }
}
