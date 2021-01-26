@extends('frontend.product_layout')

@section('title')
    {{ __('admin.cart') }}
@endsection
@section('head')
    <script src="https://www.paypal.com/sdk/js?client-id=AQeHySXR8ZsEgEyLI0xe-ALJDcfqM4JKD6aVJ6spAqBV1cnClHDnw3EUxioSaltaePF4Rq6dVeoA2Den&currency=EUR"></script>
@endsection
@section('banner_title')
    {{ __('admin.shopping_cart') }}
@endsection
@section('content')
    <div class="woocommerce-info">{{ __('admin.have_copon') }} <a class="showcoupon" data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">{{ __('admin.enter_your_code') }}</a>
    </div>

    <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

        <p class="form-row form-row-first">
            <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
        </p>

        <p class="form-row form-row-last">
            <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
        </p>

        <div class="clear"></div>
    </form>

    <form enctype="multipart/form-data" action="{{ route('customer.order') }}" class="checkout" method="post" name="checkout">
        @csrf

        <div id="customer_details" class="col2-set">
            <div class="col-md-10">
                <div class="woocommerce-billing-fields">
                    <h3>{{ __('admin.billing_details') }}</h3>
                    <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                        <label class="" for="billing_country">{{ __('admin.country') }}<abbr title="required" class="required">*</abbr>
                        </label>
                        <select class="country_to_state country_select" id="billing_country" name="country_id">
                            <option value="">{{ __('admin.select_country') }}…</option>
                            @foreach(\App\Models\Country::all() as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <p id="billing_city_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                        <label class="" for="billing_city">{{ __('admin.city') }}<abbr title="required" class="required">*</abbr>
                        </label>
                        <select class="country_to_state country_select" id="billing_city" name="city_id">
                            <option value="">{{ __('admin.select_city') }}…</option>
                        </select>
                        @error('city_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <p id="billing_shipping_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                        <label class="" for="billing_city">{{ __('admin.shipping') }}<abbr title="required" class="required">*</abbr>
                        </label>
                        <select class="country_to_state country_select" id="billing_shipping" name="shipping_company_id">
                            <option value="">{{ __('admin.select_shipping') }}…</option>
                        </select>
                        @error('shipping_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                        <label class="" for="billing_address_1">{{ __('admin.address') }} <abbr title="required" class="required">*</abbr>
                        </label>
                        <input type="text" value="" id="billing_address_1" name="address" class="input-text ">
                        @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <p id="billing_postcode_field" class="form-row form-row-last address-field validate-required validate-postcode" data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                        <label class="" for="billing_postcode">{{ __('admin.postcode') }} <abbr title="required" class="required">*</abbr>
                        </label>
                        <input type="text" value="" id="billing_postcode" name="postcode" class="input-text ">
                        @error('postcode')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <div class="clear"></div>

                    <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                        <label class="" for="billing_email">{{ __('admin.email') }} <abbr title="required" class="required">*</abbr>
                        </label>
                        <input type="text" value="{{ $customer->email }}" placeholder="" id="billing_email" name="email" class="input-text ">
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>

                    <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                        <label class="" for="billing_phone">{{ __('admin.mobile') }} <abbr title="required" class="required">*</abbr>
                        </label>
                        <input type="text" value="{{ $customer->phone_number }}" id="billing_phone" name="mobile" class="input-text ">
                        @error('mobile')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </p>
                    <div class="clear"></div>

                </div>
            </div>

        </div>

        <h3 id="order_review_heading">{{ __('admin.your_order') }}</h3>

        <div id="order_review" style="position: relative;">
            <table class="shop_table">
                <thead>
                <tr>
                    <th class="product-name">{{ __('admin.product') }}</th>
                    <th class="product-total">{{ __('admin.total') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer_products as $customer_product)
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $customer_product->product->title }} <strong class="product-quantity">× {{ $customer_product->quantity }}</strong> </td>
                        <td class="product-total">
                            <span class="amount">{{ ($customer_product->product->price - $customer_product->product->price_offer) * $customer_product->quantity }} - {{ $customer_product->product->currency->currency }}</span> </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>

                <tr class="cart-subtotal">
                    <th>{{ __('admin.cart_subtotal') }}</th>
                    <td><span class="amount">
                           {!! App\Helper\calcCartCach() !!} - EGP
                        </span>
                    </td>
                </tr>

                </tfoot>
            </table>


            <div id="payment">
                <ul class="payment_methods methods">
                    <li class="payment_method_bacs">
                        <input type="radio" data-order_button_text="" checked="checked" value="onDelivery" name="payment_method" class="input-radio" id="payment_method_bacs">
                        <label for="payment_method_bacs">{{ __('admin.pay_when_delivery') }} </label>
                    </li>
                    <li class="payment_method_paypal">
                        <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                        <label for="payment_method_paypal">{{ __('admin.paypal') }} <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">{{ __('admin.what_is_paypal') }}</a>
                        </label>
                        <div style="display:none;" class="payment_box payment_method_paypal">
                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                        </div>

                        <div class="d-none" id="paypal-button-container"></div>

                    </li>
                </ul>

                <div class="form-row place-order">
                    <input type="submit" data-value="Place order" value="Place order" id="place_order" class="button alt">
                </div>

                <div class="clear"></div>

            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01',
                            currency_code: "EUR",
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    alert('Transaction completed by ' + details.payer.name.given_name);
                });
            }
        }).render('#paypal-button-container');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('change', '#billing_country', function () {
                let country_id = $('#billing_country option:selected').val();
                $.ajax({
                    url: '{{ route('customer.get_cities') }}',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'country_id': country_id,
                    },
                    success: function (data) {
                        if (data.status === false){
                            console.log(data.data);
                        }
                        else {
                            $('#billing_city').children().remove();
                            for(let i = 0; i < data.data.length; i++){
                                $('#billing_city').append('<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>');
                            }
                        }
                    }
                });
                $.ajax({
                    url: '{{ route('customer.get_shipping_companies') }}',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'country_id': country_id,
                    },
                    success: function (data) {
                        if (data.status === false){
                            console.log(data.data);
                        }
                        else {
                            console.log(data);
                            $('#billing_shipping').children().remove();
                            for(let i = 0; i < data.data.length; i++){
                                $('#billing_shipping').append('<option value="'+data.data[i].pivot.shipping_id+'">'+data.data[i].name+'</option>');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
