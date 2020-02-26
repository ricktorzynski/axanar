<?php
/**
 * @var array $c
 * @var array $campaign
 */
$packageItems = $c['packageItems'] ?? [];
?>
<h1 class='page-header'>
    {{ $campaign['name'] }} <i class="fa fa-angle-double-right"></i> {{ $c['pkg_name'] }}
</h1>

@foreach($packageItems ?? [] as $item)
    <div class="col-md-4">
        <div class="store-item">
            <div class="store-item-image">
                <img src="/images/client/perks/1/{{ $item['image_url'] ?? 'pta-ortiz-1.jpg' }}"
                    alt class="img-responsive">
                @if($item['file_type'] === 'zip')
                    <img src="/images/overlays/perk_photo_overlay_zip.png"
                        style="position:absolute;top:0;left:0;"
                        class="img-responsive" alt>
                @endif
            </div>

            <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                <span class="store-item-price" style="font-size:14px;">{{ $item['name'] }}</span>
            </div>

            <div class="clearfix" style="text-align:center;margin-top:5px;">
                {!! $item['accessLink'] !!}
            </div>

        </div>
    </div>
@endforeach
