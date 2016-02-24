<!-- resources/views/auth/login.blade.php -->
@extends('login')


@section('content')

<div class="login">
  <form method="POST" action="/auth/login" class="login__form">
    {!! csrf_field() !!}
    <h2 class="form-signin-heading">Please sign in</h2>
    <div class="form-group">
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required="" autofocus="">
    </div>
    <div class="form-group">
      <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
    </div>
    <div class="form-group login__action">
      <div class="checkbox login__remember">
        <input id="chb1" type="checkbox" value="remember"> 
        <label for="chb1">
          Remember me
        </label>
      </div>
      <div class="login__submit">
        <button type="submit" class="btn btn-default">Sign in</button>
      </div>
    </div>
    <p>Not a member? <a class="panel-title" href="/auth/register">Register</a> today!</p>
  </form>       
</div>
      
@endsection
