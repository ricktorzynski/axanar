@extends('layouts.app')

@section('content')
    @if (session('status') === 'no-user')
        <div class="alert alert-danger" role="alert">
            <p>
                Uh, oh! We could not find that e-mail address anywhere in our system.
            </p>
            <p>
                Please double-check that you are entering the e-mail you used back when you donated to
                the Axanar Kickstarters and/or Indiegogo campaign.
            </p>
        </div>
    @endif

    <p>Welcome! And thank you for being a previous supporter of Axanar!</p>
    <p>You’re just a couple of easy steps away from being able to track your previous donations,
        check the status of your perks, and donate again to this exciting project!</p>
    <p>What we need first is the <strong>e-mail address you used when you donated previously
            through Kickstarter or Indiegogo</strong>. It MUST be that previous e-mail address if you
        want to view your donation history and perk status...</p>

    <form method="POST" action="{{ route('register.activate') }}" class="form-horizontal">
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
                    class="btn btn-success pull-right">SUBMIT
                </button>
                <input type="hidden" name="activate" value="1"/>
            </div>
        </div>
    </form>

    @include('partials.email-support', ['activating' => true])
    @include('partials.email-support')
@endsection
