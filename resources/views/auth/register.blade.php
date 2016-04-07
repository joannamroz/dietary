<!-- resources/views/auth/register.blade.php -->
@extends('login')

@section('content')

<div class="login">
  <form method="POST" action="/auth/register" class="login__form">
  {!! csrf_field() !!}
    <h2 class="form-signin-heading">Register</h2>

    <label for="inputName" class="sr-only">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required="" autofocus="">

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required="" autofocus="">
    
    <div class="form-group" name="sex" required>
      <label class="col-sm-2 sr-only">Sex</label>
      <div class="col-sm-10">
        <div class="radio radio-inline">
          <input id="r1" type="radio" name="sex" checked="checked">
          <label for="r1">Male</label>
        </div>
        <div class="radio radio-inline">
          <input id="r2" type="radio" name="sex">
          <label for="r2">Female</label>
        </div>
      </div>
    </div>

<!--     <label  class="sr-only">Date of birth</label>
    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
 -->

    <label class="sr-only">Date of birth</label>                 
    <div class="form-group">
      <div class="input-group date">
        <input type="text" value="" name="date_of_birth" placeholder="Date of birth" class="form-control">
        <div class="input-group-addon">
          <div class="fa fa-calendar"></div>
        </div>
      </div>
    </div>
                             

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required="" autofocus="">
    
    <label for="inputPassword" class="sr-only">Confirm password</label>
    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" value="{{ old('password') }}" required="" autofocus="">

    <button class="btn btn-default register-button" type="submit" style="margin-top:10px">Register</button>

  </form>
</div>
@endsection
