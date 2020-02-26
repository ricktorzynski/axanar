<?php
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')

    <h2>Change Your Email Address</h2>
    <p>Remember that by changing your email address, you're changing your user name in our system.</p>
    <p>Be aware that if you change your email to one that is not valid, you will be locked out of the system.</p>

    <p>Enter your new email address below, then type it again to confirm.</p>

    @if ($errors->has('email'))
        <div class="alert alert-danger">
            <h4><i class="fa fa-medkit"></i>Please Try Again</h4>
            <p>
                {{ $errors->first('email') }}
            </p>
        </div>
    @endif

    <hr/>

    <form method="POST" action="{{ route('account.email.change') }}" class="form-horizontal">
        @csrf

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input type="email"
                        id="email"
                        name="email"
                        class="form-control input-lg"
                        placeholder="New Email Address"
                        value="{{ old('email') }}" required autofocus>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input type="email"
                        id="email_verify"
                        name="email_verify"
                        class="form-control input-lg"
                        placeholder="New Email Address Again"
                        value="{{ old('email') }}" required autofocus>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8">
                <a href="/" class="btn btn-info pull-left">GO BACK</a>
                <button type="submit"
                    name="submit"
                    value="Change Email Address"
                    class="btn btn-success pull-right">
                    Change Email Address
                </button>
            </div>
        </div>
    </form>

    @include('partials.email-support')
@endsection
