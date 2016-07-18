@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Book {{ $book->id }}
        <a href="{{ url('member/books/' . $book->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit book"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['member/books', $book->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete book',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $book->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $book->title }} </td></tr><tr><th> Author </th><td> {{ $book->author }} </td></tr><tr><th> Isbn </th><td> {{ $book->isbn }} </td><td> {{ $book->quantities }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
