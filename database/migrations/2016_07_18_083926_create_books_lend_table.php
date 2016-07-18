<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksLendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('books_lend', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('bookid');
            $table->integer('userid');
            $table->date('startdate');
            $table->date('returndate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('books_lend');
    }
}
