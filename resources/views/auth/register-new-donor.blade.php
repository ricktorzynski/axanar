<?php
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    @if (session('status'))
        <p>Thank you. An e-mail has been sent to <strong>{{ $email }}</strong> for you to set your password.</p>
        <p>Please follow the instructions on the e-mail to activate your new Ares Digital 3.0
            account.</p>
        <p>If an e-mail does not arrive within the next few minutes, check your spam folder. If the
            problem persists, please contact Customer Service at the address below</p>
    @else
        <p>Welcome! Thank you for being a supporter of Axanar!</p>
        <p>You’re just a couple of easy steps away from being able to donate to this exciting project!</p>
        <p>First, enter your e-mail address. It will become your user name to enter the site...</p>

        @if ($errors->has('email'))
            <div class="alert alert-danger">
                <h4><i class="fa fa-medkit"></i>Error</h4>
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('register.check') }}" class="form-horizontal">
            @csrf

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
                 </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-md-offset-2 col-md-8 text-right">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    @endif

    @include('partials.email-support')
@endsection
