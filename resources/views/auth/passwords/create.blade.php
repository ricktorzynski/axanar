@extends('layouts.app')

@section('content')
    <p>
        To create your {{ config('app.versionName') }} password, enter your new password twice, and then press
        the "Set My Password" button to confirm the change.
    </p>
    <p>
        Please note: we recommend that you follow Internet best practices by choosing a password for Ares Digital 3.0
        that is unique and that you have not used, are not using, and will never use on any other internet account.
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

    <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

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

        <div class="form-group row">
            <div class="col-md-offset-2 col-md-8">
                <label for="new-eml"> <input type="checkbox" required
                        value='1'
                        class=""
                        id="age_agree"
                        name="age_agree">
                    By clicking here, I acknowledge that I am 18 years of age or older.
                </label>
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <button type="submit" class="btn btn-primary">SET MY PASSWORD</button>
            </div>
        </div>
    </form>
    @include('partials.email-support', ['activating' => true])
@endsection
