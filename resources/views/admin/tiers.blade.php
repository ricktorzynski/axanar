@extends('layouts.app-wide')
<?php
/**
 * @var array $campaigns
 * @var array $campaign
 */
?>
@section('content')
    <?php showMessages(); ?>

    <div class="list-group">
        <h2>Fulfillment Dashboard</h2>
    </div>

    <div class="container">
        <div id="mainMenu">
            @foreach($campaigns as $campaign)
                <h3>{{ $campaign['name'] }}
                    <small style="float: right;">
                        <button class="btn btn-primary btn-xs hide-fulfilled"
                            data-status="0" data-cid="{{ $campaign['campaign_id'] }}">Hide Fulfilled
                        </button>
                    </small>
                </h3>

                <div class="list-group panel">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: right;">Total Entitled</th>
                            <th style="text-align: right;">Total Fulfilled</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($campaign['items'] ?? [] as $item)
                            <tr class="{{ $item['unshippedCount'] === $item['shippedCount'] ? 'fulfilled' : null }}">
                                <td>
                                    <a href="/admin/fulfillment/tier/{{ $item['package_id'] }}" target="_blank">
                                        {{ $item['name'] }}
                                    </a>
                                </td>
                                <td style="text-align: right;">{{ $item['unshippedCount'] }}</td>
                                <td style="text-align: right;">{{ $item['shippedCount'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('body-scripts')
    <script>
      $('.list-group').on('click', '> a', function(e) {
        var $this = $(this);
        $('.list-group').find('.active').removeClass('active');
        $this.addClass('active');
      });

      $('.hide-fulfilled').on('click', function() {
        const campaignID = $(this).data('cid');
        const status = parseInt($(this).data('status'));
        if (status === 0) {
          $('tr.fulfilled').addClass('hide');
        } else {
          $('tr.fulfilled').removeClass('hide');
        }
        $(this).data('status', status === 0 ? 1 : 0);
        $(this).text(status === 0 ? 'Show All' : 'Hide Fulfilled');
        $(this).addClass(status === 0 ? 'btn-success' : 'btn-primary');
        $(this).removeClass(status === 0 ? 'btn-primary' : 'btn-success');
      });
    </script>
@endpush
