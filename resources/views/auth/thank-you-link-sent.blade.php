@extends('layouts.app')

@section('content')
    <p>Thank you. An e-mail has been sent to <strong>{{ $email }}</strong>.</p>
    <p>Please follow the instructions on the e-mail to activate your new Ares Digital 3.0
        account.</p>
    <p>If an e-mail does not arrive within the next few minutes, check your spam folder. If the
        problem persists, please contact Customer Service at the address below.</p>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    @include('partials.email-support')
@endsection
