@extends('frontend.product_layout')

@section('title')
    {{ __('admin.orders') }}
@endsection
@section('banner_title')
    {{ __('admin.orders') }}
@endsection
@section('content')
    <table cellspacing="0" class="shop_table cart">
        <thead>
        <tr>
            <th class="product-remove">&nbsp;</th>
            <th class="product-thumbnail">{{ __('admin.address') }} </th>
            <th class="product-name">{{ __('admin.email') }}</th>
            <th class="product-name">{{ __('admin.shipping') }}</th>
            <th class="product-price">{{ __('admin.product') }}</th>
            <th class="product-quantity">{{ __('admin.price') }}</th>
            <th class="product-quantity">{{ __('admin.quantity') }}</th>
            <th class="product-subtotal">{{ __('admin.total') }}</th>
        </tr>

        </thead>
            <tbody>
            @foreach($orders as $order)
            <tr class="cart_item">
                <td class="product-remove">
                    <a title="Remove this item" class="remove" href="{{ route('customer.order.delete', $order->id) }}">×</a>
                </td>

                <td class="product-thumbnail">
                    {{ $order->address }}
                </td>

                <td class="product-thumbnail">
                    {{ $order->email }}
                </td>

                <td class="product-thumbnail">
                    {{ $order->shipping->{'name_' . LaravelLocalization::getCurrentLocale()} }}
                </td>

                <td class="product-name">
                    {{ $order->customer_product->product->title }}
                </td>

                <td class="product-quantity">
                    {{ $order->customer_product->product->price - $order->customer_product->product->price_offer }} - {{ $order->customer_product->product->currency->currency }}
                </td>

                <td class="product-subtotal">
                    {{ $order->customer_product->quantity }}
                </td>

                <td class="product-subtotal">
                    {{ ($order->customer_product->product->price - $order->customer_product->product->price_offer) * $order->customer_product->quantity }} - {{ $order->customer_product->product->currency->currency }}
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
