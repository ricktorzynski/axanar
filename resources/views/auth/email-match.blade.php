<?php
//  slide 11
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    <p><strong>{{ $email }}</strong> already exists in our database.</p>
    <p>If you HAVE donated to an Axanar crowd-funding campaign in the past, you can create an account for this e-mail.</p>
    <p>If you have NOT donated to an Axanar crowd-funding campaign in the past, you will need to enter a different e-mail.</p>

    <form method="POST" action="{{ route('register.match') }}" class="form-horizontal">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="create" value="create">

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">CREATE ACCOUNT<br/>WITH THIS E-MAIL</button>
                </div>
                <div class="col-md-4">
                    <a href="/register/new-donor" class="btn btn-primary">USE A DIFFERENT<br/>E-MAIL ADDRESS</a>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="col-md-8 text-center">
                    <a href="/" class="btn btn-info">CANCEL</a>
                </div>
            </div>
        </div>
    </form>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    @include('partials.email-support')
@endsection
