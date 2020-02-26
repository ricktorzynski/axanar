<?php
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    <p>Welcome! Thank you for being a supporter of Axanar!</p>
    <p>You’re just a couple of easy steps away from being able to donate to this exciting project!</p>
    <p>First, enter your e-mail address. It will become your user name to enter the site...</p>

    @if ($errors->has('email')||$errors->has('password'))
        <div class="alert alert-danger">
            <h4><i class="fa fa-medkit"></i>Authentication Error</h4>
            <p>
                The credentials you entered are not correct.<br/>
                Please try again, or click
                <a href="/password/reset">here</a> to reset your password.
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('register.new-donor') }}" class="form-horizontal">
        @csrf

        <div class="form-group row">
            <label for="full_name"
                class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

            <div class="col-md-6">
                <input id="full_name"
                    type="text"
                    class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    required
                    autofocus>

                @if ($errors->has('full_name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email"
                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email"
                    type="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email"
                    value="{{ old('email') }}"
                    required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password"
                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password"
                    type="password"
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password"
                    required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm"
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    required>
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

    @include('partials.email-support')
@endsection
