@extends('frontend.product_layout')

@section('title')
    {{ __('admin.product') }}
@endsection
@section('banner_title')
    {{ $product->title }}
@endsection
@section('content')
    <div class="product-breadcroumb">
        <a href="{{ route('homepage') }}">{{ __('admin.home') }}</a>
        <a href="">Category Name</a>
        <a href="">{{ $product->title }}</a>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="product-images">
                <div class="product-main-img">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="">
                </div>

                <div class="product-gallery">
                    @foreach($product->files as $image)
                        <img src="{{ asset('storage/' . $image->file) }}" alt="">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="product-inner">
                <h2 class="product-name">{{ $product->title }}</h2>
                <div class="product-inner-price">
                    @if( is_null($product->price_offer) )
                        <ins>{{ $product->price }} {{ $product->currency->currency }}</ins>
                    @else
                        <ins>{{ $product->price - $product->price_offer }} {{ $product->currency->currency }}</ins> <del>{{ $product->price }} {{ $product->currency->currency }}</del>
                    @endif
                </div>

                <form action="{{ route('customer.add_to_cart', $product->id) }}" method="POST" class="cart">
                    @csrf
                    <div class="quantity">
                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" max="{{ $product->stock }}" step="1">
                    </div>
                    <button class="add_to_cart_button" type="submit">{{ __('admin.add_to_cart') }}</button>
                </form>

                {{--                                    <div class="product-inner-category">--}}
                {{--                                        <p>Category: <a href="">Summer</a>. Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>--}}
                {{--                                    </div>--}}

                <div role="tabpanel">
                    <ul class="product-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
{{--                            <h2>{{ __('admin.product_description') }}</h2>--}}
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="related-products-wrapper">
        <h2 class="related-products-title">Related Products</h2>
        <div class="related-products-carousel">
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-1.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Sony Smart TV - 2015</a></h2>

                <div class="product-carousel-price">
                    <ins>$700.00</ins> <del>$100.00</del>
                </div>
            </div>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-2.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Apple new mac book 2015 March :P</a></h2>
                <div class="product-carousel-price">
                    <ins>$899.00</ins> <del>$999.00</del>
                </div>
            </div>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-3.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Apple new i phone 6</a></h2>

                <div class="product-carousel-price">
                    <ins>$400.00</ins> <del>$425.00</del>
                </div>
            </div>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-4.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Sony playstation microsoft</a></h2>

                <div class="product-carousel-price">
                    <ins>$200.00</ins> <del>$225.00</del>
                </div>
            </div>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-5.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Sony Smart Air Condtion</a></h2>

                <div class="product-carousel-price">
                    <ins>$1200.00</ins> <del>$1355.00</del>
                </div>
            </div>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="img/product-6.jpg" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href="">Samsung gallaxy note 4</a></h2>

                <div class="product-carousel-price">
                    <ins>$400.00</ins>
                </div>
            </div>
        </div>
    </div>
@endsection
