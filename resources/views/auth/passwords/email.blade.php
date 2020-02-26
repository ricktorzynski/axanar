@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <h4><i class="fa fa-medkit"></i>RESET PASSWORD LINK SENT</h4>
            <p>Thank you. An e-mail has been sent to
                <strong>{{ session('resetEmailAddress') ?? 'your email' }}</strong> with a special reset code and link.
            <p>Please follow the instructions on the e-mail to reset your account password.</p>
            <p>If an e-mail does not arrive within the next few minutes, check your spam folder. If the
                problem persists, please contact Customer Service at the address below. </p>
        </div>
    @else
        <p>So you forgot your password? No worries! Just type in the e-mail address you used
            to create your Ares Digital 3.0 account, and we’ll send you a special code to reset your
            password.</p>

        @if ($errors && $errors->has('email'))
            <div class="alert alert-danger">
                <h4><i class="fa fa-medkit"></i>Invalid Email Address</h4>
                <p>
                    {{ $errors->first('email') }}
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="form-horizontal">
            @csrf
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                        <input type="email"
                            id="email"
                            name="email"
                            class="form-control input-lg"
                            value="{{ $email ?? old('email') }}"
                            placeholder="Email Address"
                            required
                            autofocus>
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-md-offset-2 col-md-8">
                    <a href="/" class="btn btn-info pull-left">GO BACK</a>
                    <button type="submit"
                        name="submit"
                        value="Reset Password"
                        class="btn btn-success pull-right">SEND MY RESET CODE
                    </button>
                    <input type="hidden" name="activate" value="0"/>
                </div>
            </div>
        </form>
    @endif
    @include('partials.email-support')
@endsection
