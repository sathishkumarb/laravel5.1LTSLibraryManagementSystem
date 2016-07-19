<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class BookFine extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books_fines';

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
    protected $fillable = ['bookid', 'userid', 'returndate', 'fines'];
	
}
