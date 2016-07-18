<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'author', 'isbn', 'quantities', 'shelflocation'];
	
	protected function searchbook($keyword){
		$books = DB::table('books')
                     ->select(DB::raw('count(*) as book_count, id, title, quantities, author'))
                     ->where("title", "LIKE","%$keyword%")
                     ->orWhere("author", "LIKE", "%$keyword%")
					 ->get();
		return $books;
	}

    protected function searchbookbyid($bookid){
        $books = DB::table('books_lend')->where('bookid', '=', $bookid)->groupBy('bookid')->count();
        return $books;
    }

    protected function searchbookslendedbyuser($id){
        $books = DB::table('books_lend')
                     ->select(DB::raw('count(*) as books_count'))
                     ->where('userid', '=', $id)
                     ->get();
        return $books;
    }
}
