@extends('layouts.app')

@section('content')
    <p>
        To reset your {{ config('app.versionName') }} password, enter your new password twice, and then press
        the "Change Password" button to confirm the change.
    </p>
    <p>
        Be sure to follow internet best practices by choosing a password for {{ config('app.versionName') }} that is unique and that you have not used, are
        not using, and will never use on any other internet account.
    </p>

    @if ($errors->has('email')||$errors->has('password'))
        <div class="alert alert-danger">
            <h4><i class="fa fa-medkit"></i>Please Try Again</h4>
            <p>
                {{ $errors->has('email') ? $errors->first('email') : $errors->first('password') }}
            </p>
        </div>
    @endif

    <hr/>
    
    <form method="POST" action="{{ route('password.newreset') }}" class="form-horizontal">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                    <input type="email"
                        id="email"
                        name="email"
                        class="form-control input-lg"
                        placeholder="Email Address"
                        value="{{ $email ?? old('email') }}" required autofocus>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password"
                        id="password"
                        name="password"
                        class="form-control input-lg"
                        placeholder="New Password">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-offset-2 col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password"
                        id="password-confirm"
                        name="password_confirmation"
                        class="form-control input-lg"
                        placeholder="Confirm New Password" required>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <button type="submit" class="btn btn-primary">CHANGE MY PASSWORD</button>
            </div>
        </div>
    </form>
    @include('partials.axanar-support')
@endsection
