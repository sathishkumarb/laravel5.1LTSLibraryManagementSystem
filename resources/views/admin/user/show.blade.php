@extends('layouts.app')

@section('content')
<div class="container">

    <h1>User {{ $User->id }}
        <a href="{{ url('admin/users/' . $User->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/users', $User->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete user',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $User->id }}</td>
                </tr>
                <tr>
                    <th> Name </th><td> {{ $User->name }} </td>
                </tr>
                <tr><th> Email </th><td> {{ $User->email }} </td></tr>
               <tr><th> age </th><td> {{ $User->age }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
