@extends('frontend.layout')

@section('title')
    {{ __('admin.shop') }}
@endsection

@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>{{ __('admin.shop') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->title }}">
                        </div>
                        <h2><a href="{{ route('customer.product.page', $product->id) }}">{{ $product->title }}</a></h2>
                        <div class="product-carousel-price">
                            @if( is_null($product->price_offer) )
                                <ins>{{ $product->price }} {{ $product->currency->currency }}</ins>
                            @else
                                <ins>{{ $product->price - $product->price_offer }} {{ $product->currency->currency }}</ins> <del>{{ $product->price }} {{ $product->currency->currency }}</del>
                            @endif
                        </div>

                        {{ $products->links() }}

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('customer.product.page', $product->id) }}">{{ __('admin.add_to_cart') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
@endsection
