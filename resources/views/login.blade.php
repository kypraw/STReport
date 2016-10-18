@extends('layouts.master')

@section('content')
<div class="col-md-4 col-md-offset-4">
<form class="form-signin" method="post" action="{{ route('login.post') }}">
        <header class="text-center"><h2>Login</h2></header>
        <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Kemenkeu"  value="{{ Request::old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>
        {{csrf_field()}}
        <button class="btn btn-md btn-primary btn-block" type="submit">Login</button>
      </form>
</div>
@endsection