<x-front-layout title="{{ __('Checkout') }}">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Checkout') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                            <li>{{ __('Checkout') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!--====== Checkout Form Steps Part Start ======-->

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('checkout') }}" method="post" id="payment-form">
                        @csrf
                        <div class="checkout-steps-form-style-1">
                            <ul id="accordionExample">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">
                                        {{ __('Your Personal Details') }} </h6>
                                    <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('User Name') }}</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input required id="billing_first_name"
                                                                name="addr[billing][first_name]" :value="old('addr.billing.first_name')"
                                                                placeholder="{{ __('First Name') }}" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input required id="billing_last_name"
                                                                name="addr[billing][last_name]" :value="old('addr.billing.last_name')"
                                                                placeholder="{{ __('Last Name') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Email Address (optional)') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input id="billing_email" name="addr[billing][email]"
                                                            :value="old('addr.billing.email')"
                                                            placeholder="{{ __('Email Address') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Phone Number') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="billing_phone_number"
                                                            name="addr[billing][phone_number]" :value="old('addr.billing.phone_number')"
                                                            placeholder="{{ __('Phone Number') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Mailing Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="billing_street_address"
                                                            name="addr[billing][street_address]" :value="old('addr.billing.street_address')"
                                                            placeholder="{{ __('Mailing Address') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('City') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="billing_city"
                                                            name="addr[billing][city]" :value="old('addr.billing.city')"
                                                            placeholder="{{ __('City') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Post Code (optional)') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input id="billing_postal_code"
                                                            name="addr[billing][postal_code]" :value="old('addr.billing.postal_code')"
                                                            placeholder="{{ __('Post Code') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Region/State (optional)') }}</label>
                                                    <div class="select-items">
                                                        <x-form.input id="billing_state" name="addr[billing][state]"
                                                            :value="old('addr.billing.state')" placeholder="{{ __('State') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Country') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.select required id="billing_country" :value="old('addr.billing.country')"
                                                            name="addr[billing][country]" :options="$countries" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" id="checkbox-3">
                                                    <label for="checkbox-3"><span></span></label>
                                                    <p>{{ __('My delivery and mailing addresses are the same.') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseFour">{{ __('next step') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        {{ __('Shipping Address') }}
                                    </h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('User Name') }}</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input id="shipping_first_name" required
                                                                name="addr[shipping][first_name]" :value="old('addr.shipping.first_name')"
                                                                placeholder="{{ __('First Name') }}" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input id="shipping_last_name" required
                                                                :value="old('addr.shipping.last_name')" name="addr[shipping][last_name]"
                                                                placeholder="{{ __('Last Name') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Email Address (optional)') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input id="shipping_email" name="addr[shipping][email]"
                                                            :value="old('addr.shipping.email')"
                                                            placeholder="{{ __('Email Address') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Phone Number') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="shipping_phone_number"
                                                            name="addr[shipping][phone_number]" :value="old('addr.shipping.phone_number')"
                                                            placeholder="{{ __('Phone Number') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Mailing Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="shipping_street_address"
                                                            name="addr[shipping][street_address]" :value="old('addr.shipping.street_address')"
                                                            placeholder="{{ __('Mailing Address') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('City') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input required id="shipping_city"
                                                            name="addr[shipping][city]" :value="old('addr.shipping.city')"
                                                            placeholder="{{ __('City') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Post Code (optional)') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input id="shipping_postal_code"
                                                            name="addr[shipping][postal_code]" :value="old('addr.shipping.postal_code')"
                                                            placeholder="{{ __('Post Code') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Region/State (optional)') }}</label>
                                                    <div class="select-items">
                                                        <x-form.input id="shipping_state" name="addr[shipping][state]"
                                                            :value="old('addr.shipping.state')" placeholder="{{ __('State') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Country') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.select required id="shipping_country"
                                                            :value="old('addr.shipping.country')" name="addr[shipping][country]"
                                                            :options="$countries" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">{{ __('previous') }}</button>

                                                    <button class="btn"
                                                        type="submit">{{ __('Save & Continue') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        {{-- <div class="checkout-sidebar-coupon">
                            <p>{{ __('Apply Coupon to get discount!') }}</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="{{ __('Coupon Code') }}">
                                    </div>
                                    <div class="button">
                                        <button class="btn">{{ __('apply') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        <div class="checkout-sidebar-price-table mt-30">
                            <p class="title">{{ __('You Pay') }}</p>

                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">{{ __('Subtotal Price:') }}</p>
                                    <p class="price">{{ Currency::format($cart->total()) }}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">{{ __('Shipping') }}</p>
                                    <p class="price">{{ __('Free') }}</p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">{{ __('Tax') }}</p>
                                    <p class="price">$00.00</p>
                                </div>
                            </div>

                            <div class="total-payable">
                                <div class="payable-price" style="background: rgb(172, 183, 194); padding: 8px">
                                    <p class="value" style="color: blue; font-weight: bold">
                                        {{ __('Subtotal Price:') }}</p>
                                    <p class="price" style="color: blue; font-weight: bold">
                                        {{ Currency::format($cart->total()) }}</p>
                                </div>
                            </div>
                            {{-- <div class="price-table-btn button">
                                <a href="javascript:void(0)" class="btn btn-alt">{{ __('Checkout') }}</a>
                            </div> --}}
                        </div>
                        {{-- <div class="checkout-sidebar-banner mt-30">
                            <a href="product-grids.html">
                                <img src="https://via.placeholder.com/400x330" alt="#">
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#checkbox-3').on('change', function() {
                    if ($(this).prop('checked')) {
                        $('#shipping_first_name').val($('#billing_first_name').val());
                        $('#shipping_last_name').val($('#billing_last_name').val());
                        $('#shipping_email').val($('#billing_email').val());
                        $('#shipping_phone_number').val($('#billing_phone_number').val());
                        $('#shipping_street_address').val($('#billing_street_address').val());
                        $('#shipping_city').val($('#billing_city').val());
                        $('#shipping_postal_code').val($('#billing_postal_code').val());
                        $('#shipping_state').val($('#billing_state').val());
                        $('#shipping_country').val($('#billing_country').val());
                    } else {
                        $('#shipping_first_name').val('');
                        $('#shipping_last_name').val('');
                        $('#shipping_email').val('');
                        $('#shipping_phone_number').val('');
                        $('#shipping_street_address').val('');
                        $('#shipping_city').val('');
                        $('#shipping_postal_code').val('');
                        $('#shipping_state').val('');
                        $('#shipping_country').val('');
                    }
                });
            });
        </script>
    @endpush
</x-front-layout>
