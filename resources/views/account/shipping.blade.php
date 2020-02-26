<?php
/**
 * @var string $icon
 * @var string $msg
 */
?>
@extends('layouts.app')

@section('mediaTitle', 'Shipping & Perk Personalization')

@section('content')
    <?php showMessages($msg, "UPDATE SUCCESSFUL", $icon, false); ?>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <h4 class="page-header">SHIPPING ADDRESS</h4>
            <strong>{{ trim(($userInfo['firstName'] ?? null) . ' ' . ($userInfo['lastName'] ?? null)) }}</strong>
            <address>{!! $address ?? 'NONE ON FILE' !!}</address>
        </div>

        <div class="col-md-offset-2 col-md-8">
            <h4 class="page-header">PERK PERSONALIZATION</h4>
            <table class="perk-personalization">
                <tbody>
                <tr>
                    <td><i class="fa fa-fw fa-2x fa-venus-mars"></i></td>
                    <td>T-Shirt Style:</td>
                    <td>{{ $userInfo['gender'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-fw fa-2x fa-suitcase"></i></td>
                    <td>T-Shirt Size:</td>
                    <td>{{ $userInfo['shirtSize'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-fw fa-2x fa-list-ul"></i></td>
                    <td>Donor Listed As:</td>
                    <td>{{ $donorListedAs }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-offset-2 col-md-8">
            <h4 class="page-header">ACCOUNT SETTINGS</h4>
            <address><i class="fa fa-envelope-o"></i> &nbsp;
                <strong>Email:</strong>&nbsp;{{ $userInfo['email'] ?? 'NONE ON FILE' }}
                <br/><i class="fa fa-key"></i> &nbsp; <strong>Password:</strong> ****
            </address>
        </div>
    </div>

    <form id="contact-info" name="contact-info" method="POST">
        @csrf

        <div class="col-md-offset-2 col-md-8">
            <h4 class="page-header"><i class="fa fa-gear"></i> &nbsp;<strong>UPDATE SHIPPING ADDRESS</strong>
            </h4>
            <div class="form-group">
                <label for="contact-firstname">First Name</label>
                <input type="text"
                    id="contact-firstname"
                    name="contact-firstname"
                    class="form-control"
                    value="{{ $userInfo['firstName'] ?? null }}"
                    placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label for="contact-lastname">Last Name</label>
                <input type="text"
                    id="contact-lastname"
                    name="contact-lastname"
                    class="form-control"
                    value="{{ $userInfo['lastName'] ?? null }}"
                    placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label for="contact-address1">Address Line 1</label>
                <input type="text"
                    id="contact-address1"
                    name="contact-address1"
                    class="form-control"
                    value="{{ $userInfo['address_1'] ?? null }}"
                    placeholder="Enter Address Line 1">
            </div>
            <div class="form-group">
                <label for="contact-address2">Address Line 2</label>
                <input type="text"
                    id="contact-address2"
                    name="contact-address2"
                    class="form-control"
                    value="{{ $userInfo['address_2'] ?? null }}"
                    placeholder="Enter Address Line 2 or Ignore if Not Applicable">
            </div>
            <div class="form-group">
                <label for="contact-city">City</label>
                <input type="text"
                    id="contact-city"
                    name="contact-city"
                    class="form-control"
                    value="{{ $userInfo['city'] ?? null }}"
                    placeholder="Enter City">
            </div>
            <div class="form-group">
                <label for="contact-state">State / Province</label>
                <input type="text"
                    id="contact-state"
                    name="contact-state"
                    class="form-control"
                    value="{{ $userInfo['state'] ?? null }}"
                    placeholder="Enter State / Province">
            </div>
            <div class="form-group">
                <label for="contact-zip">ZIP / Postal Code</label>
                <input type="text"
                    id="contact-zip"
                    name="contact-zip"
                    class="form-control"
                    value="{{ $userInfo['zip'] ?? null }}"
                    placeholder="Enter ZIP / Postal Code">
            </div>
            <div class="form-group">
                @include('partials.shipping-country')
            </div>
        </div>
        <div class="col-md-offset-2 col-md-8">
            <h4 class="page-header"><i class="fa fa-gear"></i> &nbsp;UPDATE PERK PERSONALIZATION</h4>
            <p>Please note that {{ config('app.versionName') }} is requesting the
                following personalization information from every donor, and it does not necessarily mean that
                your specific donation package includes a perk such as a t-shirt, video disc, or other
                preference that is being requested. We're doing this to help us gauge sizing statistics for
                future perk offerings and which quantities of each size would be needed from the chosen
                manufacturer. This information will not be shared with anyone outside
                of {{ config('app.versionName') }} or {{ config('app.versionName') }} proper -- internal use only,
                guaranteed. If you have a question as to whether your donation package includes such items then
                please visit your account dashboard and review your specific donation details.</p>
            <div class="form-group">
                <label for="contact-gender">Clothing Style</label>
                <select id="contact-gender" name="contact-gender" class="form-control" size="1">
                    <option value="" disabled selected>Please Select Clothing Style</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact-shirtsize">Clothing Size</label>
                <select id="contact-shirtsize" name="contact-shirtsize" class="form-control" size="1">
                    <option value="" disabled selected>Please Select Your Clothing Size</option>
                    <option value="Adult XS">Adult XS</option>
                    <option value="Adult S">Adult S</option>
                    <option value="Adult M">Adult M</option>
                    <option value="Adult L">Adult L</option>
                    <option value="Adult XL">Adult XL</option>
                    <option value="Adult 2XL">Adult 2XL</option>
                    <option value="Adult 3XL">Adult 3XL</option>
                </select>
            </div>
            <h4 class="page-header"><i class="fa fa-list-ul"></i>&nbsp;DONOR LIST ALTERNATE NAME</h4>
            <div class="form-group">
                <label for="contact-altname">Donor List Alternate Listing</label>
                <p>On the Donors Listing on the Axanar.com website, as a donor,
                    your name will appear as First Name + Last Name (e.g.
                    "John Buck"), if you would prefer to have it appear as something else, or a nickname,
                    please enter it below (max of 40 characters).</p>
                <input type="text" id="contact-altname" name="contact-altname" class="form-control"
                    value="{{ $altName }}" placeholder="{{ $altName }}">
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-offset-2 col-md-8 text-right">
                <button type="submit" name="submit" value="Save Changes" class="btn btn-success">
                    <i class="fa fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </form>
@endsection

@push('body-scripts')
    <script>
      console.log('UserInfo', @json($userInfo));
      $(function() {
        $('#contact-shirtsize').val('{{ $userInfo['shirtSize'] ?? '' }}');
        $('#contact-gender').val('{{ $userInfo['gender'] ?? '' }}');
        $('#contact-country').val('{{ $userInfo['country'] ?? '' }}');
      });
    </script>
@endpush
