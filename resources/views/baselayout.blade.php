@extends('baselayout')

@section('content')

<div class="row">
	<h1>Welcome to my website</h1>

	<h2>Sign In</h2>
	{!! Html::ul($errors->all(), array('class'=>'errors')) !!}

	{!! Form::open(array('url' => 'signin','class'=>'form-inline')) !!}

	{!! Form::label('email', 'E-Mail Address') !!}
	{!! Form::text('email', 'example@gmail .com', array('class' => 'form-control')) !!}
	{!! Form::label('password', 'Password') !!}
	{!! Form::password('password', array('class' => 'form-control')) !!}

	{!! Form::submit('Sign In' , array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
</div>

@stop