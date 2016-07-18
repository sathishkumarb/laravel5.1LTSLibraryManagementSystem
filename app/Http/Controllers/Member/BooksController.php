<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\BookLend;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;
use Auth;
use DateTime;



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
        $book = Book::findOrFail($id);

        return view('member.books.show', compact('book'));
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

    /**
     * Search the book bon on keyword.
     *
     * @param  request  $request
     *
     * @return void
     */
    public function listborrowbook(){

        $user = Auth::user();

        $books = BookLend::join('books', 'books_lend.bookid', '=', 'books.id')->where('userid', '=', $user->id)->select('books_lend.*', 'books.title', 'books.author')->get(); 

        return view('member.books.listborrowbook')->with('books', $books);                 
    }


    /**
     * Search the book bon on keyword.
     *
     * @param  request  $request
     *
     * @return void
     */
	public function searchbook(Request $request){
		$name = $request->input('search');

		$books = Book::searchbook($name);		 

		return view('member.books.search')->with('books', $books);                 
	}

    public function bookborrow(Request $request, $id){

        $user = Auth::user();

        $Book = Book::findOrFail($id);


        if ( isset($Book->id) && $Book->quantities > 0) {
           
            $bookscount =  Book::searchbookbyid($id);
  
            if ($bookscount === $Book->quantities){

                echo "No stock(s) available";
                exit;

            }
            
        } 

        if (isset($request) && !empty($request->input('returndate')))
        {

            $userbooks = Book::searchbookslendedbyuser($user->id);

            if ( $user->age <=12 && $userbooks[0]->books_count <=2)
            {

                $now = new DateTime();
               
                $request->merge([ 'bookid' => $id ]);
                $request->merge([ 'userid' => $user->id ]);
                $request->merge([ 'startdate' => $now ]);

                BookLend::create($request->all());

                Session::flash('flash_message', 'Book Borrowed!');

                return redirect('member/booksearch');
            } 
            else if( $user->age > 12 && $userbooks[0]->books_count <=5)
            {
                $now = new DateTime();
               
                $request->merge([ 'bookid' => $id ]);
                $request->merge([ 'userid' => $user->id ]);
                $request->merge([ 'startdate' => $now ]);

                BookLend::create($request->all());

                Session::flash('flash_message', 'Book Borrowed!');

                return redirect('member/booksearch');
            } 
            else
            {
                echo "Maximum boosk allowed is 6 for elders and 3 for juniors";
                exit;
            }
            
        }
      
               
        return view('member.books.borrowbook',compact('Book'));

    }
}
