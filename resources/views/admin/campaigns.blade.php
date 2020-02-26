@extends('layouts.app-wide')

@section('mediaTitle', 'Administrative Dashboard')

@section('content')
    <div id="viewDetails" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="detail-header">Modal Header</h4>
                </div>
                <div class='alert alert-success fade in' style="display: none" id='userMsg'></div>
                <div class="modal-body" id='modal-body'>
                    <div class="row">
                        <div class="col-sm-2">Add&nbsp;Sku&nbsp;Item</div>
                        <div class="col-sm-10" id="detail-skuId"><select id="skuId" value="skuId">
                                <?php
                                $itms = getSkuItems();
                                foreach ($itms as $itm) {
                                    echo "<option value='" . $itm['sku_id'] . "'>" . $itm['name'] . "</option>";
                                }
                                ?>
                            </select></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-default"
                        onclick="addSkuItem();$('#packageForm').modal('hide')">
                        Save
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php showMessages(); ?>

    <div class="list-group">
        <h3>Campaign Administration</h3>
    </div>

    <div class="container">
        <div id="MainMenu">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach($campaigns as $campaign)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="h_{{ $campaign['collapseID'] }}">
                            <h4 class="panel-title" style="font-size: 24px;">
                                <a role="button"
                                    data-toggle="collapse"
                                    data-parent="#accordion"
                                    href="#{{ $campaign['collapseID'] }}"
                                    aria-expanded="true"
                                    aria-controls="{{ $campaign['collapseID'] }}"
                                    class="collapsed">
                                    {{$campaign['name']}}
                                </a>
                            </h4>
                        </div>

                        <div id="{{ $campaign['collapseID'] }}"
                            class="panel-collapse collapse in"
                            role="tabpanel"
                            aria-labelledby="h_{{ $campaign['collapseID'] }}">
                            <div class="panel-body">

                                @foreach($campaign['elements'] ?? [] as $element)
                                    @if (!empty($element['packageItems']))
                                        <div class="panel-group" role="tablist">
                                            <div class="panel panel-default">
                                                <div class="panel-heading"
                                                    role="tab"
                                                    id="h{{ $campaign['collapseID'] }}p{{ $element['package_id'] }}">
                                                    <h4 class="panel-title">
                                                        <a href="#h{{ $campaign['collapseID'] }}pe{{ $element['package_id'] }}"
                                                            class=""
                                                            role="button"
                                                            data-toggle="collapse"
                                                            aria-expanded="true"
                                                            aria-controls="h{{ $campaign['collapseID'] }}pe{{ $element['package_id'] }}">
                                                            {{$element['packageName']}}
                                                        </a>
                                                        <small>
                                                            <button class="btn btn-warning btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#viewDetails"
                                                                style="margin-top: -2px; float: right"
                                                                onclick="addEntry('{{$element['packageName']}}', {{$element['package_id']}})">Add Item to Package
                                                            </button>
                                                        </small>
                                                    </h4>
                                                </div>

                                                <div class="panel-collapse collapse in"
                                                    role="tabpanel"
                                                    id="h{{ $campaign['collapseID'] }}pe{{ $element['package_id'] }}"
                                                    aria-labelledby="h{{ $campaign['collapseID'] }}p{{ $element['package_id'] }}"
                                                    aria-expanded="true"
                                                    style="">
                                                    @foreach($element['packageItems']??[] as $packageItem)
                                                        <li class="list-group-item">
                                                            {{$packageItem['name']}} <span
                                                                class="fa fa-trash"
                                                                onclick="removeSkuItem({{$packageItem['id']}});"></span>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
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

      var _package_id = 0;

      function addEntry(name, pid) {
        $('.modal-title')[0].innerHTML = name;
        _package_id = pid;
      }

      function addSkuItem() {
        if (_package_id > 0) {
          packageId = _package_id;
          skuId = $('#skuId').val();
          if (confirm('are you sure you want to add that sku item to the package?')) {
            $.ajax({
              type: 'POST',
              url: 'admin-package-adjust.php',
              data: 'action=add&packageId=' + packageId + '&skuId=' + skuId,
              success: function(msg) {
                result = JSON.parse(msg);
                if (result.status && result.status == 'ok') {
                  $('#viewDetails').modal('hide');
                  location = 'admin-campaigns.php';
                } else {
                  alert('Something went wrong. Please try again!');
                }
              },
            });
          }
        }
      }

      function removeSkuItem(packageSkuItemId) {
        if (confirm('are you sure you want to remove that sku item from the package?')) {
          $.ajax({
            type: 'POST',
            url: 'admin-package-adjust.php',
            data: 'action=remove&packageSkuItemId=' + packageSkuItemId,
            success: function(msg) {
              result = JSON.parse(msg);
              if (result.status && result.status == 'ok') {
                //mTable.ajax.reload(null, true);
                $('#viewDetails').modal('hide');
                location = 'admin-campaigns.php';
              } else {
                alert('Something went wrong. Please try again!');
              }
            },
          });
        }
      }
    </script>
@endpush
