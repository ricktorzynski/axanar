@extends('layouts.app-wide')

@section('content')
    <?php showMessages(); ?>

    <div>
        <a href="/dashboard" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Dashboard</a>
    </div>
    @foreach($donations as $c)
        @include('partials.single-donation', ['c' => $c, 'campaign'=> $campaign])
    @endforeach

    <div class="col-md-4">
        <div class="store-item">
            <div class="store-item-image"><img src="/images/client/perks/1/ares-patch.jpg"
                    alt=""
                    class="img-responsive"></div>
            <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                                <span class="store-item-price themed-color-dark pull-right"
                                    style="padding-left:15px;"></span>
                <em>Access to 'Axanar Donor Station'</em><BR>PASSWORD IS "Ajax61"
            </div>

            <div class="clearfix" style="text-align:center;margin-top:5px;">
                <a href="http://www.axanar.com/donate/donor-station/">CLICK TO ACCESS</a><br/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <hr>
        <p>
            <b>ZIP COMPRESSION</b> &mdash; Some of the digital downloads offered on {{ config('app.versionName') }} have been compressed with the
            industry standard
            <strong>ZIP</strong> format. If you experience trouble opening any zip files you may need a third-party application.
            <a href="http://winzip.com" target="_blank">Winzip.com</a> is a good place to start.
        </p>
        <p>
            <b>VIDEO PLAYBACK</b> &mdash; Most MKV and MP4 players should open without issue on your device. If you have trouble, we recommend the
            open-source VLC Media Player. It's available free, for all platforms. You can get a copy on their website
            <a href="http://www.videolan.org/vlc" target="_blank">videolan.com</a>.
        </p>
        <p>
            <b>ANTI-VIRUS FALSE POSITIVES:</b> &mdash; Some anti-virus software does not care for .pdf files that are delivered in a .zip file
            and may report a warning or a false positive when you attempt to download such files. All files offered on {{ config('app.versionName') }} are wholly within our control and
            have been thoroughly scanned before being offered to you, so it is our recommendation that you override the false positive and continue downloading if you
            experience this situation.</p>
        <br/>
    </div>
@endsection
