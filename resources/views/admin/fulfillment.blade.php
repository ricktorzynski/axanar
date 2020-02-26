@extends('layouts.app-wide')

@section('mediaTitle', 'Administrative Dashboard')

@section('content')
    <?php showMessages(); ?>

    <div class="list-group">
        <h3>Fulfillment Dashboard</h3>
    </div>

    <?php
    $items = getPhysicalSkuItems() ?: [];
    ?>

    <div class="container">
        <div id="mainMenu">
            <div class="list-group panel">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Total Entitled</th>
                        <th>Total Fulfilled</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $item)
                        <?php
                        $id = $item['sku_id'];
                        $unshippedItems = getListToShipForItem($id);
                        $shippedItems = getListShippedForItem($id);
                        $unshippedCount = count($unshippedItems ?: []);
                        $shippedCount = count($shippedItems ?: []);
                        ?>
                        <tr>
                            <td>
                                <a href="/admin/fulfillment/items/{{ $item['sku_id'] }}"
                                    target="_blank">{{ $item['name'] }}</a>
                            </td>
                            <td>{{ $unshippedCount }}</td>
                            <td>{{ $shippedCount }}</td>
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
      $('.list-group').on('click', '> a', function(e) {
        var $this = $(this);
        $('.list-group').find('.active').removeClass('active');
        $this.addClass('active');
      });
    </script>
@endpush
