@extends('baselayout')

@section('content')

<div class="row">
<form method="POST" action="{{ action("Auth\AdminAuthController@getLogin") }}">
    {!! csrf_field() !!}
    
<h2>Sign In</h2>
    {!! HTML::ul($errors->all(), array('class'=>'errors')) !!}

    {!! Form::open(array('url' => 'signin','class'=>'form-inline')) !!}

    {!! Form::label('email', 'E-Mail Address') !!}
    {!! Form::text('email', 'example@gmail .com', array('class' => 'form-control')) !!}
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', array('class' => 'form-control')) !!}

    {!! Form::submit('Sign In' , array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
    
</form>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif