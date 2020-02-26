<?php
/**
 * @var string $icon
 * @var string $msg
 */
?>
@extends('layouts.app-wide')

@section('mediaTitle', 'Complete Registration')

@section('content')
    <form method="POST" action="{{ route('complete.password') }}" class="form-horizontal">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user['user_id'] }}"/>

        <div class="row">
            <div class="col-md-3">
                <h3>COMPLETE ACCOUNT SET-UP</h3>
                <p>
                    REQUIRED - Please provide the following required information below (it will not be shared with any outside party, company, or individual):
                </p>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="contact-firstname">First Name</label>
                    <input type="text"
                        id="contact-firstname"
                        name="contact-firstname"
                        class="form-control"
                        value="{{ $user['firstName'] ?? null }}"
                        placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label for="contact-lastname">Last Name</label>
                    <input type="text"
                        id="contact-lastname"
                        name="contact-lastname"
                        class="form-control"
                        value="{{ $user['lastName'] ?? null }}"
                        placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                    <label for="contact-address1">Address Line 1</label>
                    <input type="text"
                        id="contact-address1"
                        name="contact-address1"
                        class="form-control"
                        value="{{ $user['address_1'] ?? null }}"
                        placeholder="Enter Address Line 1" required>
                </div>
                <div class="form-group">
                    <label for="contact-address2">Address Line 2 (Optional)</label>
                    <input type="text"
                        id="contact-address2"
                        name="contact-address2"
                        class="form-control"
                        value="{{ $user['address_2'] ?? null }}"
                        placeholder="Enter Address Line 2 or Ignore if Not Applicable">
                </div>
                <div class="form-group">
                    <label for="contact-city">City</label>
                    <input type="text"
                        id="contact-city"
                        name="contact-city"
                        class="form-control"
                        value="{{ $user['city'] ?? null }}"
                        placeholder="Enter City"  required>
                </div>
                <div class="form-group">
                    <label for="contact-state">State/Province</label>
                    <input type="text"
                        id="contact-state"
                        name="contact-state"
                        class="form-control"
                        value="{{ $user['state'] ?? null }}"
                        placeholder="Enter State/Province" required>
                </div>
                <div class="form-group">
                    <label for="contact-zip">ZIP/Postal Code</label>
                    <input type="text"
                        id="contact-zip"
                        name="contact-zip"
                        class="form-control"
                        value="{{ $user['zip'] ?? null }}"
                        placeholder="Enter ZIP/Postal Code"  required>
                </div>
                <div class="form-group">
                    @include('partials.shipping-country')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-3 col-md-5">
                <fieldset>
                    <legend>OPTIONAL - Perk Personalization</legend>
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
                </fieldset>

                <fieldset>
                    <legend>OPTIONAL - Donor List Alternate Name</legend>
                    <div class="form-group">
                        <label for="contact-altname">Donor List Alternate Listing</label>
                        <p>On the Donors Listing on the Axanar.com website, as a donor,
                            your name will appear as First Name + Last Name (e.g.
                            "John Buck"), if you would prefer to have it appear as something else, or a nickname,
                            please enter it below (max of 40 characters).</p>
                        <input type="text" id="contact-altname" name="contact-altname" class="form-control"
                            value="{{ $user['altName'] }}" placeholder="{{ $user['altName'] }}">
                    </div>
                </fieldset>
            </div>

            <div class="form-group form-actions">
                <div class="col-md-offset-3 col-md-7 text-right">
                    <button type="submit" class="btn btn-primary">COMPLETE REGISTRATION</button>
                </div>
            </div>
        </div>
    </form>
@endsection
