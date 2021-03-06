@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Book {{ $Book->id }}</h1>

    {!! Form::model($Book, [
        'method' => 'PATCH',
        'url' => ['/admin/books', $Book->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
                {!! Form::label('author', 'Author', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('author', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('isbn') ? 'has-error' : ''}}">
                {!! Form::label('isbn', 'Isbn', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('isbn', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('quantities') ? 'has-error' : ''}}">
                {!! Form::label('quantities', 'Quantities', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('quantities', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('quantities', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('shelflocation') ? 'has-error' : ''}}">
                {!! Form::label('shelflocation', 'Shelflocation', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('shelflocation', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('shelflocation', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection