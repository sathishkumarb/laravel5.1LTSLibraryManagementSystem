<form method="POST" action="{{ action("AdminAuth\AdminPasswordController@getEmail") }}">
    {!! csrf_field() !!}
 
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
 
    <div>
        <button type="submit">
            Send Password Reset Link
        </button>
    </div>
</form>