<!DOCTYPE html>
<html lang="en">
@section('title')
 home
@stop
@include('WebSite.layouts.head')
<body>
    <div class="page-wrapper">
        @include('WebSite.layouts.header')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <main class="main">
            <div class="intro-slider-container">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                        "dots": false,
                        "nav": false,
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                    @if (count($banners) > 0)
                    @foreach ( $banners as $banner)
                    <div class="intro-slide" style="background-image: url('/banner_images/{{$banner->photo}}');">
                        <div class="container intro-content text-center">
                            <h3 class="intro-subtitle text-white">{{$banner->description}}</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">{{$banner->title}}</h1><!-- End .intro-title -->
                            <a href="{{route('shop')}}" class="btn btn-outline-white-4">
                                <span>Discover More</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div><!-- End .intro-slider owl-carousel owl-theme -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="pt-2 pb-3">
                <div class="container">
                    <div class="row">
                        @if (count($categories) > 0)
                        @foreach ( $categories as $category)
                        <div class="col-sm-6" >
                            <div class="banner banner-overlay">
                                <a href="#" style="height: 598px">
                                    <img style="height: 100%" src="/category_images/{{$category->photo}}" alt="Banner">
                                </a>
                                <div class="banner-content banner-content-center">
                                    <h4 class="banner-subtitle text-white"><a href="#">{{$category->summary}}</a></h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white"><a href="#"><strong>{{$category->title}}</strong></h3><!-- End .banner-title -->
                                    <a href="{{route('product.category', $category->slug)}}" class="btn btn-outline-white banner-link underline">Shop Now</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-6 -->
                        @endforeach
                        @endif
                    </div><!-- End .row -->
                    <hr class="mt-0 mb-0">
                </div><!-- End .container -->
            </div><!-- End .bg-gray -->

            <div class="mb-5"></div><!-- End .mb-5 -->
            @php
                $popular_product = \App\Models\Product::where(['status' => 'active' , 'conditions' => 'popular'])->orderBy('id','DESC')->paginate(12);
            @endphp
            <div class="container">
                <h2 class="title text-center mb-4">POPULAR</h2><!-- End .title text-center -->


                <div class="products">
                    <div class="row justify-content-center">
                @if (count($popular_product) > 0)
                @foreach ($popular_product as $item)
                                @include('WebSite.layouts.Product_Card')
                @endforeach
                @endif
              </div>
            </div>
                <div class="more-container text-center mt-2">
                    <a href="{{route('shop')}}" class="btn btn-outline-dark-2 btn-more"><span>show more</span></a>
                </div><!-- End .more-container -->
            </div>
            <div class="mb-5"></div><!-- End .mb-5 -->

            <div class="deal bg-image pt-8 pb-8" style="background-image: url(WebSite/assets/images/demos/demo-6/deal/bg-1.jpg);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="deal-content text-center">
                                <h4>Limited quantities. </h4>
                                <h2>Deal of the Day</h2>
                                <div class="deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                            </div><!-- End .deal-content -->
                            <div class="row deal-products">
                                <div class="col-6 deal-product text-center">
                                    <figure class="product-media">
                                        <a href="">
                                            <img src="WebSite/assets/images/demos/demo-6/deal/product-1.jpg" alt="Product image" class="product-image">
                                        </a>

                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.html">Elasticated cotton shorts</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="new-price">Now {{Helper::currency_converter(24.99)}}</span>
                                            <span class="old-price">Was {{Helper::currency_converter(30.99)}}</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    <a href="{{route('shop')}}" class="action">shop now</a>
                                </div>
                                <div class="col-6 deal-product text-center">
                                    <figure class="product-media">
                                        <a href="">
                                            <img src="WebSite/assets/images/demos/demo-6/deal/product-2.jpg" alt="Product image" class="product-image">
                                        </a>

                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.html">Fine-knit jumper</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="new-price">Now {{Helper::currency_converter(8.99)}}</span>
                                            <span class="old-price">Was {{Helper::currency_converter(17.99)}}</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    <a href="{{route('shop')}}" class="action">shop now</a>
                                </div>
                            </div>
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .deal -->

            <div class="pt-4 pb-3" style="background-color: #222;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-truck"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                                    <p>Free shipping for orders over $50</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-rotate-left"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                                    <p>Free 100% money back guarantee</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-unlock"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Secure Payment</h3><!-- End .icon-box-title -->
                                    <p>100% secure payment</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-headphones"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                                    <p>Alway online feedback 24/7</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .bg-light pt-2 pb-2 -->

            <div class="mb-6"></div><!-- End .mb-5 -->
            @php
                $new_product = \App\Models\Product::where(['status' => 'active' , 'conditions' => 'new'])->orderBy('id','DESC')->paginate(12);
            @endphp
            <div class="container">
                <h2 class="title text-center mb-4">New Arrivals</h2><!-- End .title text-center -->


                <div class="products">
                    <div class="row justify-content-center">
                    @if (count($new_product) > 0)
                @foreach ($new_product as $item)
                                @include('WebSite.layouts.Product_Card')
                @endforeach
                @endif
                </div>
                </div>
                <div class="more-container text-center mt-2">
                    <a href="{{route('shop')}}" class="btn btn-outline-dark-2 btn-more"><span>show more</span></a>
                </div><!-- End .more-container -->
            </div><!-- End .container -->

            <div class="pb-3">
                <div class="container brands pt-5 pt-lg-7 ">

                    <h2 class="title text-center mb-4">shop by brands</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple" data-toggle="owl"
                        data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                        @if(count($brands) > 0)
                            @foreach($brands as $brand)
                        <a href="#" class="brand">
                            <img src="/brand_images/{{$brand->photo}}" alt="Brand Name">
                        </a>
                            @endforeach
                        @endif
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->

                <div class="mb-5 mb-lg-7"></div><!-- End .mb-5 -->
            </div><!-- End .bg-gray -->

            <div class="mb-2"></div><!-- End .mb-5 -->

            <div class="container">
            </div><!-- End .container -->

            <div class="bg-light pt-5 pb-6">
                <div class="container trending-products">
                    <div class="heading heading-flex mb-3">
                        <div class="heading-left">
                            <h2 class="title">Trending Products</h2><!-- End .title -->
                        </div><!-- End .heading-left -->

                        <div class="heading-right">
                            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="trending-top-link" data-toggle="tab" href="#trending-top-tab" role="tab" aria-controls="trending-top-tab" aria-selected="true">Top Rated</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-best-link" data-toggle="tab" href="#trending-best-tab" role="tab" aria-controls="trending-best-tab" aria-selected="false">Best Selling</a>
                                </li>
                            </ul>
                        </div><!-- End .heading-right -->
                    </div><!-- End .heading -->

                    <div class="row">
                        <div class="col-xl-4-5 col">
                            <div class="tab-content tab-content-carousel just-action-icons-sm">
                                <div class="tab-pane p-0 fade active show" id="trending-top-tab" role="tabpanel" aria-labelledby="trending-top-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                                            &quot;nav&quot;: true,
                                            &quot;dots&quot;: false,
                                            &quot;margin&quot;: 20,
                                            &quot;loop&quot;: false,
                                            &quot;responsive&quot;: {
                                                &quot;0&quot;: {
                                                    &quot;items&quot;:2
                                                },
                                                &quot;480&quot;: {
                                                    &quot;items&quot;:2
                                                },
                                                &quot;768&quot;: {
                                                    &quot;items&quot;:3
                                                },
                                                &quot;992&quot;: {
                                                    &quot;items&quot;:4
                                                }
                                            }
                                        }">
                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1188px;">
                                                @foreach($best_rated as $item)
                                                    <div class="owl-item active" style="width: 217.598px; margin-right: 20px;">
                                                        <div class="product product-2">
                                                            <figure class="product-media">
                                                                <span class="product-label label-sale">{{$item->conditions}}</span>
                                                                <a href="{{route('product.detail',$item->slug)}}">
                                                                    <img src="/product_images/{{ $item->images[0]->image }}" alt="Product image" style="height: 300px;width: 100%;" class="product-image">
                                                                    <img src="/product_images/{{ $item->images[1]->image }}" alt="Product image" class="product-image-hover">
                                                                </a>

                                                                <div class="product-action-vertical">
                                                                    <a href="#" data-quantity="1" data-id="{{$item->id}}"
                                                                       id="add_to_wishlist_{{$item->id}}"
                                                                       class="add_to_wishlist btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                                </div><!-- End .product-action-vertical -->

                                                                <div class="product-action">
                                                                    <a href="#" data-quantity="1"
                                                                       data-product-id="{{$item->id}}"
                                                                       id="add-to-cart{{$item->id}}"
                                                                       class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>
                                                                </div><!-- End .product-action -->
                                                            </figure><!-- End .product-media -->
                                                            <div class="product-body">
                                                                <div class="product-cat">
                                                                    <a href="#">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</a>
                                                                </div><!-- End .product-cat -->
                                                                <h3 class="product-title"><a
                                                                        href="{{route('product.detail',$item->slug)}}">{{$item->title}}</a>
                                                                </h3><!-- End .product-title -->
                                                                <div class="product-price">
                                                                    <span class="new-price"><del>{{Helper::currency_converter($item->price)}}</del></span>
                                                                    <span class="old-price">{{Helper::currency_converter($item->offer_price)}}</span>
                                                                </div><!-- End .product-price -->
                                                                <div class="ratings-container">
                                                                    <div class="rating">
                                                                        @for($i =0 ; $i < 5 ; $i++)
                                                                            @if(round($item->reviews->avg('rate'))>$i)
                                                                                <i class="fa-star star fas"></i>
                                                                            @else
                                                                                <i class="far fa-star star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <span class="ratings-text">( {{\App\Models\ProductReview::where('product_id' , $item->id)->count()}} Reviews )</span>
                                                                </div><!-- End .rating-container -->
                                                            </div><!-- End .product-body -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div><div class="owl-dots disabled"></div></div><!-- End .owl-carousel -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane p-0 fade" id="trending-best-tab" role="tabpanel" aria-labelledby="trending-best-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                                            &quot;nav&quot;: true,
                                            &quot;dots&quot;: false,
                                            &quot;margin&quot;: 20,
                                            &quot;loop&quot;: false,
                                            &quot;responsive&quot;: {
                                                &quot;0&quot;: {
                                                    &quot;items&quot;:2
                                                },
                                                &quot;480&quot;: {
                                                    &quot;items&quot;:2
                                                },
                                                &quot;768&quot;: {
                                                    &quot;items&quot;:3
                                                },
                                                &quot;992&quot;: {
                                                    &quot;items&quot;:4
                                                }
                                            }
                                        }">
                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->

                                        <!-- End .product -->
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1188px;">
                                                @foreach($best_sellings as $item)
                                                    <div class="owl-item active" style="width: 217.598px; margin-right: 20px;">
                                                        <div class="product product-2">
                                                            <figure class="product-media">
                                                                <span class="product-label label-sale">{{$item->conditions}}</span>
                                                                <a href="{{route('product.detail',$item->slug)}}">
                                                                    <img src="/product_images/{{ $item->images[0]->image }}" alt="Product image" style="height: 300px;width: 100%;" class="product-image">
                                                                    <img src="/product_images/{{ $item->images[1]->image }}" alt="Product image" class="product-image-hover">
                                                                </a>

                                                                <div class="product-action-vertical">
                                                                    <a href="#" data-quantity="1" data-id="{{$item->id}}"
                                                                       id="add_to_wishlist_{{$item->id}}"
                                                                       class="add_to_wishlist btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                                </div><!-- End .product-action-vertical -->

                                                                <div class="product-action">
                                                                    <a href="#" data-quantity="1"
                                                                       data-product-id="{{$item->id}}"
                                                                       id="add-to-cart{{$item->id}}"
                                                                       class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>
                                                                </div><!-- End .product-action -->
                                                            </figure><!-- End .product-media -->
                                                            <div class="product-body">
                                                                <div class="product-cat">
                                                                    <a href="#">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</a>
                                                                </div><!-- End .product-cat -->
                                                                <h3 class="product-title"><a
                                                                        href="{{route('product.detail',$item->slug)}}">{{$item->title}}</a>
                                                                </h3><!-- End .product-title -->
                                                                <div class="product-price">
                                                                    <span class="new-price"><del>{{Helper::currency_converter($item->price)}}</del></span>
                                                                    <span class="old-price">{{Helper::currency_converter($item->offer_price)}}</span>
                                                                </div><!-- End .product-price -->
                                                                <div class="ratings-container">
                                                                    <div class="rating">
                                                                        @for($i =0 ; $i < 5 ; $i++)
                                                                            @if(round($item->reviews->avg('rate'))>$i)
                                                                                <i class="fa-star star fas"></i>
                                                                            @else
                                                                                <i class="far fa-star star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <span class="ratings-text">( {{\App\Models\ProductReview::where('product_id' , $item->id)->count()}} Reviews )</span>
                                                                </div><!-- End .rating-container -->
                                                            </div><!-- End .product-body -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div><div class="owl-dots disabled"></div></div><!-- End .owl-carousel -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .col-xl-4-5col -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div>
        </main>
        <!-- End .main -->

       @include('WebSite.layouts.footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.mobil-menu')

    @include('WebSite.layouts.add_delete_wishlist')

    @include('WebSite.layouts.add_delete_cart')

    @include('WebSite.layouts.auto_search')

    @include('WebSite.layouts.footer-scripts')
</body>


</html>



