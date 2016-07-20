<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\BookLend;
use App\BookFine;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;
use Auth;
use DateTime;



class BooksController extends Controller
{
    
     /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "user";
        $this->middleware('auth');
    }
    /**
     * list the book broorwed.
     *
     * @param  request  $request
     *
     * @return void
     */
    public function listborrowbook()
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $books = BookLend::join('books', 'books_lend.bookid', '=', 'books.id')->where('userid', '=', $user->id)->select('books_lend.*', 'books.title', 'books.author')->get(); 
            //$books = BookLend::join('books', 'books_lend.bookid', '=', 'books.id')->where('userid', '=', 1)->select('books_lend.*', 'books.title', 'books.author')->get(); 

        }
        return view('member.books.listborrowbook')->with('books', $books);
    }

  
    /**
     * Search the book upon keyword.
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

    /**
     * borrow book
     *
     * @param  request  $request , int id
     *
     * @return void
     */
    public function bookborrow(Request $request, $id){

        $user = Auth::user();

        $Book = Book::findOrFail($id);

        if ( isset($Book->id) && $Book->quantities > 0) {
           
            $bookscount =  Book::searchbookbyid($id);
  
            if ($bookscount === $Book->quantities){

                echo "No book stock(s) available";
                exit;

            }
            
        } 


        $userbooks = Book::searchbookslendedbyuser($user->id);
        $flag  = 0;

        if ( $user->age <=12 && $userbooks[0]->books_count <=2)
        {
             $flag = 1;
        } 
        else if( $user->age > 12 && $userbooks[0]->books_count <=5)
        {
            $flag = 2;
        } 

        if ($flag)
        {
            $now = new DateTime();
           
            $request->merge([ 'bookid' => $id ]);
            $request->merge([ 'userid' => $user->id ]);
            $request->merge([ 'startdate' => $now ]);

            BookLend::create($request->all());

            $decQuantities = $Book->quantities - 1 ;
            $Book->quantities = $decQuantities;
          
            $Book->save();

            Session::flash('flash_message', 'Book Borrowed!');

            return redirect('member/booksearch');
        }
        else
        {
            echo "Maximum books allowed is 6 for elders and 3 for juniors";
            exit;
        }
        return;
                    
    }


    /**
     * return book
     *
     * @param  request  $request , int id
     *
     * @return void
     */
    public function bookreturn(Request $request, $id)
    {
        $user = Auth::user();

        $BookLend = BookLend::findOrFail($id);

        $Book = Book::findOrFail($BookLend->bookid);

        if ( isset($BookLend->id) ) 
        {
            $mytime = Carbon::now(); // today

            $now = new DateTime();
               
            $request->merge([ 'bookid' => $id ]);
            $request->merge([ 'userid' => $user->id ]);
            $request->merge([ 'returndate' => $now ]);

            $carbondt = new Carbon($BookLend->startdate);

            $returnDateExpiry = $carbondt->copy()->addWeeks(2)."<br>";    

            if (!empty($BookLend) && $mytime > $returnDateExpiry  ) {
           
                echo $difference = ($carbondt->diff($now)->days < 1) ? '' : $carbondt->diff($now)->days;

                $request->merge([ 'fines' => '$'.$difference ]);

            }
            

            BookFine::create($request->all());

            BookLend::destroy($id);

            

            $incQuantities = $Book->quantities + 1;
            $Book->quantities = $incQuantities;
          
            $Book->save();

            Session::flash('flash_message', 'Book Borrowed!');

            return redirect('member/booksearch');
            
        } 
     
        return;
    }
}
