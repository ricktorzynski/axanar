@extends('layouts.app-wide')
<?php
/**
 * @var array $order
 * @var array $orders
 * @var array $shipped
 * @var array $item
 * @var int   $skuID
 */
?>
@section('content')
    <?php showMessages(); ?>
    <div class="list-group">
        <h3>Fulfillment Item Overview</h3>
        <h4>{{ $item['name'] }}
            <small style="float: right;"><a class='btn btn-warning btn-xs'
                    href="/admin/fulfillment/item/{{ $skuID }}/shippingList" target="_blank">Download Shipping List</a>
                <a class='btn btn-danger btn-xs'
                    href="/admin/fulfillment/items/{{ $skuID }}?all=1">Mark All Shipped</a></small>
        </h4>
    </div>

    <div class="container">
        <div id="mainMenu">
            <div class="list-group panel panel-highlight">
                <table class="table table-condensed table-featured table-light table-striped table-responsive-md">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th style="text-align: center;">Shipped</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <?php
                        $email = $order['email'];
                        $userId = $order['user_id'];
                        $has = checkListForShipped($userId, $filled);
                        $status = $has ? 'Yes' : 'No';
                        $action = $has ? 0 : 1;
                        $btnText = $has ? 'Mark Unshipped' : 'Mark Shipped';
                        $btnClass = $has ? 'btn-danger' : 'btn-success';
                        ?>
                        <tr>
                            <td>{{ $order['full_name'] }}</td>
                            <td><a href="mailto:{{ $email }}" target="_blank">{{ $email }}</a></td>
                            <td id="status_{{ $userId }}" style="text-align: center;">{{ $status }}</td>
                            <td style="text-align: center;">
                                <button id="toggle_{{ $userId }}"
                                    type="button"
                                    class="btn {{ $btnClass }} btn-xs"
                                    data-action="{{ $action }}"
                                    data-uid="{{ $userId }}"
                                    data-sid="{{ $skuID }}">
                                    {{ $btnText }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('body-scripts')
    <script>
      const updateToggleUI = (userID, skuID, action) => {
        $('#status_' + userID).html(action === 1 ? 'Yes' : 'No');
        $('#toggle_' + userID).
            text(action === 1 ? 'Mark Unshipped' : 'Mark Shipped').
            data('action', action === 1 ? '0' : '1').
            addClass(action === 1 ? 'btn-danger' : 'btn-success').
            removeClass(action === 1 ? 'btn-success' : 'btn-danger');
      };

      const toggleShipping = (userID, skuID, action) => {
        $.ajax({
          type: 'POST',
          url: '/admin/fulfillment/item/' + skuID + '/setShipping',
          data: {
            _token: '{{ csrf_token() }}',
            action: action,
            userId: userID,
            skuId: skuID,
          },
          success: function(msg) {
            if (msg && msg.success) {
              updateToggleUI(userID, skuID, action);
            }
          },
        });
      };

      $('.list-group').on('click', '> a', function() {
        $('.list-group').find('.active').removeClass('active');
        $(this).addClass('active');
      });

      $('button[id^=toggle_]').on('click', function() {
        const userID = $(this).data('uid');
        const skuID = $(this).data('sid');
        const action = parseInt($(this).data('action'));
        toggleShipping(userID, skuID, action);
      });
    </script>
@endpush
