<?php
if (Illuminate\Support\Facades\Auth::check()) {
    redirect()->route('dashboard');
}
?>
@extends('layouts.app')

@section('content')
    <p>{{ old('email') }} already exists in our database.</p>
    <p>If you HAVE donated to an Axnanar crowd-funding campaign in the past, you can create an account for this e-mail.</p>
    <p>If you have NOT donated to an Axnanar crowd-funding campaign in the past, you will need to enter a different e-mail.</p>

    <form method="POST" action="{{ route('register.check') }}" class="form-horizontal">
        @csrf

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <button type="submit" name="create" class="btn btn-primary">CREATE ACCOUNT<br/>WITH THIS E-MAIL</button>
                <button type="submit" name="different" class="btn btn-primary">USE A DIFFERENT<br/>E-MAIL ADDRESS
                </button>
                <button type="submit" name="cancel" class="btn btn-info">CANCEL</button>
            </div>
        </div>
    </form>

    @include('partials.email-support')
@endsection
