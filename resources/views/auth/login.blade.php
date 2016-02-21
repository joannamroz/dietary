<!-- resources/views/auth/login.blade.php -->
@extends('login')


@section('content')
<!-- <div class="block-blur"> -->
  <div class="login">
    <form method="POST" action="/auth/login" class="login__form">
      {!! csrf_field() !!}
      <h2 class="form-signin-heading">Please sign in</h2>
      <div class="form-group">
        <!-- <label for="inputEmail" class="sr-only">Email address</label> -->
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}"required="" autofocus="">
      </div>
      <div class="form-group">
        <!-- <label for="inputPassword" class="sr-only">Password</label> -->
        <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required="">
      </div>
      <div class="form-group login__action">
        <div class="checkbox login__remember">
          <!-- <input id="chb1" type="checkbox">
          <label for="chb1">Remember</label> -->
          <label for="chb1">
            <input id="chb1" type="checkbox" value="remember"> Remember me
          </label>
        </div>
        <div class="login__submit">
          <button type="submit" class="btn btn-default">Sign in</button>
        </div>
      </div>
        <a class="btn btn-default register-button" href="/auth/register" role="button">Register</a>
    </form>       
</div>

        
@endsection
