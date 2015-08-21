<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="col-md-6">
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Sex

        <select name="sex" class = "select2">
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select>
    </div>

    <div>
        Date of birth
        
        <input type="date" name="date_of_birth" id="datepicker" value="{{ old('date_of_birth') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div class="col-md-6">
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>