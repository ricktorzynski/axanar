<?php

/**
 * @var array $campaigns
 * @var array $inactiveCampaigns
 */
?>
@extends('layouts.app-wide')

@section('content')
<section class="site-content site-section">
    <div class=container>

        <section id=legend>
            <div class=container>
                <div class=row>
                    <div class="col-xs-12 col-md-6 text-center">
                        <img src="/images/crewfromshoot.jpg" class="img-responsive center-block">
                    </div>
                    <div class="col-xs-12 col-md-6">

                        <h1 class="text-center">Axanar is in Production!</h1>

                        <p class="text-center" style="font-size: 26px;">Please help us make the Star Trek you want to see!</p>

                        <div class="text-center font-weight-bold" style="margin: 40px; ">
                            <a href="https://aresdigital.axanar.com/wp/product/axanar-october-shoot-fundraiser/" target="_new"><button class="btn-lg btn-info" style="font-size: 60px;">Donate Now!</button></a>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 text-center" style="margin-top: 20px;">

                        <a href="https://axanarproductions.com/axanar-newsletter/"><button class="btn btn-info">Sign Up for Axanar Newsletter</button></a>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-center" style="margin-top: 20px;">

                        <a href="dashboard"><button class="btn btn-info">Continue to Donor Dashboard</button></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

@endsection

@push('body-scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
@endpush