<?php
//  slide 12
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    <p>There is already an Ares Digital 3.0 account set up for <strong>{{ $email }}</strong>.</p>
    <p>Would you like to...?</p>

    <form method="POST" action="{{ route('register.match') }}" class="form-horizontal">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group form-actions">
            <div class="col-md-offset-1 col-md-8 text-center">
                <a href="/login" class="btn btn-primary">LOGIN WITH<br/>THIS E-MAIL ADDRESS</a>
                <a href="/register/new-donor" class="btn btn-primary">USE A DIFFERENT<br/>E-MAIL ADDRESS</a>
                <br/>
                <br/>
                <br/>
                <a href="/" class="btn btn-info">CANCEL</a>
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
