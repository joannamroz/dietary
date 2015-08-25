<!-- resources/views/auth/login.blade.php -->
@extends('login')
@section('title')
@endsection

@section('content')
<div class="block-blur">
    <form method="POST" action="/auth/login" class="form-signin">
        {!! csrf_field() !!}
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}"required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember"> Remember me
              </label>
            </div>
            <button class="btn btn-blue btn-primary btn-block" type="submit">Sign in</button>

    </form>
        <a href="/auth/register" type="button" class="btn btn-blue btn-primary btn-block" style="margin-top:5px">Register</a>
</div>

        
@endsection
