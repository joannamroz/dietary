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
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}"required="" autofocus="">
    
    <div class="checkbox" name="sex" required>
      <label>
        <input type="radio" name="sex" value="male" required> Male
      </label>
      <label>
        <input type="radio" name="sex" value="female" required> Female
      </label>
    </div>

<!--     <label  class="sr-only">Date of birth</label>
    <input type="date" name="date_of_birth" placeholder="Date of birth" class="form-control" value="{{ old('date_of_birth') }}">
 -->
    <div>
          <div class="input-group date">
            <input type="text" value="" placeholder='Date of Birth' class="form-control">
            <div class="input-group-addon">
              <div class="fa fa-calendar"></div>
            </div>
          </div>
    </div>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}"required="" autofocus="">
    
    <label for="inputPassword" class="sr-only">Confirm password</label>
    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" value="{{ old('password') }}"required="" autofocus="">

    <button class="btn btn-default register-button" type="submit" style="margin-top:10px">Register</button>


  </form>
</div>
@endsection

<!-- <div class="panel-body">
  <div class="form">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date</label>
          <div class="input-group date">
            <input type="text" value="12/01/2015" class="form-control">
            <div class="input-group-addon">
              <div class="fa fa-calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->