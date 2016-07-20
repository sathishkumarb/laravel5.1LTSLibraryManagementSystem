<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\BookLend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "admin";
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::paginate(15);

        //return view('user.index', compact('users'));
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        if (Auth::check())
        {
            $users = User::paginate(15);

            return view('admin.users', compact('users'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function books()
    {
        //if (Auth::check())
        {
            $books = Book::paginate(15);

            return view('admin.books.index', compact('books'));
        }
    }

      /**
     * list the book broorwed.
     *
     * @param  request  $request
     *
     * @return void
     */
    public function listborrowbookadmin()
    {
       // if (Auth::check())
        {
            //$user = Auth::user();
            $books = BookLend::join('books', 'books_lend.bookid', '=', 'books.id')->select('books_lend.*', 'books.title', 'books.author', 'books.quantities')->get(); 
            //$books = BookLend::join('books', 'books_lend.bookid', '=', 'books.id')->where('userid', '=', 1)->select('books_lend.*', 'books.title', 'books.author')->get(); 

        }
        return view('admin.books.listborrowbookall')->with('books', $books);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
       //dd(\Auth::user('admin'));
       return Redirect::to('admin/books'); // redirect the user to the login screen
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
