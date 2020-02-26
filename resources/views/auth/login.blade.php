<?php
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    @if ($errors->has('email')||$errors->has('password'))
        <div class="alert alert-danger">
            <h4><i class="fa fa-medkit"></i>Authentication Error</h4>
            <p>
                The e-mail address or Password you entered was not recognized. Please be certain to
                enter the e-mail address you used to create your Ares Digital 3.0 account.
            </p>
        </div>
    @endif

    <p>
        Please enter your e-mail address and password below...
    </p>

    <form method="POST" action="{{ route('login') }}" class="form-horizontal">
        @csrf

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                    <input type="email"
                        id="email"
                        name="email"
                        class="form-control input-lg"
                        placeholder="Email Address"
                        value="{{ old('email') }}" required autofocus>
                    <input type="hidden" name="fli" value="1">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password"
                        id="password"
                        name="password"
                        class="form-control input-lg"
                        placeholder="Password">
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8">
                <a href="/" class="btn btn-info pull-left">GO BACK</a>
                <button type="submit" name="submit" value="Log In" class="btn btn-success pull-right">LOG IN</button>
            </div>
        </div>
        <span class="pull-left"><small><a href="/password/reset">Click here if you FORGOT YOUR PASSWORD</a></small></span>
    </form>

    @include('partials.email-support')
@endsection
