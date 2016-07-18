@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<div class="container">

    <h1>Borrow Book {{ $Book->id }}</h1>

    {!! Form::model($Book, [
        'method' => 'PATCH',
        'url' => ['/member/bookborrow', $Book->id],
        'class' => 'form-horizontal'
    ]) !!}


    <div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
        {!! Form::label('returndate', 'Return Date', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('returndate', null, array('type' => 'text', 'class' => 'form-control datepicker','placeholder' => 'Pick the date this task should be completed', 'id' => 'returndate')) !!}
            {!! $errors->first('returndate', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('quantities') ? 'has-error' : ''}}">
        {!! Form::label('quantities', 'Quantities', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('quantities', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('quantities', '<p class="help-block">:message</p>') !!}
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


<script type="text/javascript">
  $(function() {
    $( "#returndate" ).datepicker();
  });
</script>
</div>
@endsection