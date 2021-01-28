@extends('frontend.product_layout')

@section('title')
    {{ __('admin.cart') }}
@endsection
@section('banner_title')
    {{ __('admin.shopping_cart') }}
@endsection
@section('content')
    <form method="post" action="{{ route('customer.update_cart') }}" id="cartForm">
        @csrf

        <table cellspacing="0" class="shop_table cart">
            <thead>
            <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name">{{ __('admin.product') }}</th>
                <th class="product-price">{{ __('admin.price') }}</th>
                <th class="product-quantity">{{ __('admin.quantity') }}</th>
                <th class="product-subtotal">{{ __('admin.total') }}</th>
            </tr>
            </thead>
            @foreach($customer_products as $key => $customer_product)
                <tbody>
                <tr class="cart_item">
                    <td class="product-remove">
                        <a title="Remove this item" class="remove" href="{{ route('customer.delete_product', $customer_product->id) }}">×</a>
                    </td>

                    <td class="product-thumbnail">
                        <a href="{{ route('customer.product.page', $customer_product->product_id) }}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{ asset('storage/' . $customer_product->product->main_image) }}"></a>
                    </td>

                    <td class="product-name">
                        <a href="{{ route('customer.product.page', $customer_product->product_id) }}">{{ $customer_product->product->title }}</a>
                    </td>

                    <td class="product-price">
                        <span class="amount">{{ $customer_product->product->price - $customer_product->product->price_offer }} - {{ $customer_product->product->currency->currency }}</span>
                    </td>

                    <td class="product-quantity">
                        <div class="quantity buttons_added">
                            <input type="number" size="4" name="quantity[{{ $customer_product->id }}]" class="input-text qty text" title="Qty" value="{{ $customer_product->quantity }}" min="0" max="{{ $customer_product->product->stock }}" step="1">
                        </div>
                    </td>

                    <td class="product-subtotal">
                        <span class="amount">{{ $customer_product->quantity * ($customer_product->product->price - $customer_product->product->price_offer) }} - {{ $customer_product->product->currency->currency }}</span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="actions" colspan="6">
                    <input type="submit" value="{{ __('admin.update_cart') }}" name="update_cart" class="button" id="updateCart">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
@endsection

@section('scripts')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $(document).on('click', '#updateCart', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                let formdata = document.getElementById('cartForm');--}}
{{--                let data = new FormData(formdata);--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('customer.update_cart') }}',--}}
{{--                    data: data,--}}
{{--                    method: 'POST',--}}
{{--                    success: function (data) {--}}
{{--                        if (data.status === true)--}}
{{--                            alert(data);--}}
{{--                        else--}}
{{--                            alert('Failed');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
