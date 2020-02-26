@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <h4><i class="fa fa-medkit"></i>RESET PASSWORD LINK CREATED</h4>
            <p>
                <strong>{{ session('status') ?? 'No status' }}</strong>
            </p>
        </div>
    @else
        <p>Create a reset password link for user.</p>

        @if ($errors && $errors->has('email'))
            <div class="alert alert-danger">
                <h4><i class="fa fa-medkit"></i>Invalid Email Address</h4>
                <p>
                    {{ $errors->first('email') }}
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.createResetLink') }}" class="form-horizontal">
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
