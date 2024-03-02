<!DOCTYPE html>
<html lang="en">
@section('title')
Product Detail
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
        <div class="sticky-bar">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <figure class="product-media">
                            <a href="{{route('product.detail',$products->slug)}}">
                                <img src="/product_images/{{$products->images[0]->image}}" alt="Product image">
                            </a>
                        </figure><!-- End .product-media -->
                        <h4 class="product-title"><a href="{{route('product.detail',$products->slug)}}">{{$products->title}}</a></h4><!-- End .product-title -->
                    </div><!-- End .col-6 -->

                    <div class="col-6 justify-content-end">
                        <div class="product-price">
                            {{Helper::currency_converter($products->offer_price)}}
                        </div><!-- End .product-price -->
                        {{-- <div class="product-details-quantity">
                            <input type="number"  id="sticky-cart-qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required="" style="display: none;">
                        </div><!-- End .product-details-quantity --> --}}

                        <div class="product-details-action">
                            <a href="#" data-quantity="1" data-product-id="{{$products->id}}" id="add-to-cart{{$products->id}}" class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>
                            <a href="#"  data-quantity="1" data-id="{{$products->id}}" id="add_to_wishlist_{{$products->id}}"  class="add_to_wishlist btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div><!-- End .product-details-action -->
                    </div><!-- End .col-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div>
        <main class="main" style="padding-top: 30px">
            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <figure  style="width: 100%" class="product-main-image">
                                            <img id="product-zoom" src="/product_images/{{$products->images[0]->image}}" data-zoom-image="WebSite/assets/images/products/single/1-big.jpg" alt="product image">


                                        </figure><!-- End .product-main-image -->

                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title">{{$products->title}}</h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( {{\App\Models\ProductReview::where('product_id' , $products->id)->count()}} Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        {{Helper::currency_converter($products->offer_price)}}
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p>{{$products->summary}} </p>
                                    </div><!-- End .product-content -->


                                    @php
                                    $product_attr = \App\Models\ProductAttribute::where('product_id' , $products->id)->get();
                                    @endphp

                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="#" selected="selected">Select a size</option>
                                                @foreach($product_attr as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- End .select-custom -->

                                        <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                    </div><!-- End .details-filter-row -->

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" name="quantity" id="sticky-cart-qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required="" style="display: none;">
                                        </div>
                                    </div><!-- End .details-filter-row -->

                                    <div class="product-details-action">
                                        <a href="#" data-quantity="1" data-product-id = "{{$products->id}}" id="add-to-cart{{$products->id}}" class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>

                                        <div class="details-action-wrapper">
                                            <a href="#"  data-quantity="1" data-id="{{$products->id}}" id="add_to_wishlist_{{$products->id}}"  class="add_to_wishlist btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" data-quantity="1" data-id="{{$products->id}}" id="add_to_compare_{{$products->id}}" class="btn-product btn-compare add_to_compare" title="Compare"><span>Add to Compare</span></a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="#">{{\App\Models\Category::where('id',$products->cat_id)->value('title')}}</a>,

                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="false">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="true">Shipping &amp; Returns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{\App\Models\ProductReview::where('product_id' , $products->id)->count()}})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Product Information</h3>
                                    @if ($products->description)
                                      <p>{{$products->description}}</p>
                                    @else
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur repudiandae ut corrupti, voluptatibus magnam animi excepturi nisi qui est accusantium a. Libero reiciendis iste eos veniam impedit commodi accusantium? Deserunt?</p>
                                    @endif
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <h3>Information</h3>
                                    <p>{{$products->additional_info}}</p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade active show" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                                <div class="product-desc-content">
                                    <h3>Delivery &amp; returns</h3>
                                    <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div id="review_div" class="reviews">
                                    @auth
                                    <h1>Submit Review Rating</h1>
                                    <form id="reviewForm" action="{{route('product.review' , $products->slug)}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="rating">
                                                <input type="hidden" required id="rating" name="rating">
                                                <i class="far fa-star star" data-value="1"></i>
                                                <i class="far fa-star star" data-value="2"></i>
                                                <i class="far fa-star star" data-value="3"></i>
                                                <i class="far fa-star star" data-value="4"></i>
                                                <i class="far fa-star star" data-value="5"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                                            <input type="hidden" name="product_id" value="{{$products->id}}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="options">Reason For Your Rating</label>
                                            <select class="form-control" required id="options"  name="reason">
                                                <option value="quality">Quality</option>
                                                <option value="value" >Value</option>
                                                <option value="design" >Design</option>
                                                <option value="price" >Price</option>
                                                <option value="others" >Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Comments:</label>
                                            <textarea class="form-control" required id="review" name="review" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    @else
                                        <p>You Need To Login For Write Review. <a href="{{route('user.auth')}}">Click Here</a>To Login</p>
                                    @endif

                                    @php
                                    $reviews = \App\Models\ProductReview::where('product_id' ,$products->id)->latest()->paginate(5);
                                    @endphp

                                        <h3 class="mt-2">Reviews</h3>
                                        @if(count($reviews) > 0)
                                            @foreach($reviews as $review)
                                        <div class="review">
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <h4><a href="#">{{\App\Models\User::where('id' , $review->user_id)->value('full_name')}}</a></h4>
                                                    <div class="ratings-container">
                                                        <div class="rating">
                                                            @for($i =0 ; $i < 5 ; $i++)
                                                                @if($review->rate > $i)
                                                                    <i class="fa-star star fas"></i>

                                                                @else
                                                                    <i class="far fa-star star"></i>
                                                                @endif
                                                            @endfor
                                                        </div><!-- End .ratings -->
                                                    </div><!-- End .rating-container -->
                                                    <span class="review-date">{{\Carbon\Carbon::parse($review->created_at)->format('M d y')}}</span>
                                                </div><!-- End .col -->
                                                <div class="col">
                                                    <h4>For {{ucfirst($review->reason)}}</h4>

                                                    <div class="review-content">
                                                        <p>{{$review->review}}</p>
                                                    </div><!-- End .review-content -->
                                                </div><!-- End .col-auto -->
                                            </div><!-- End .row -->
                                        </div><!-- End .review -->
                                            @endforeach
                                        @endif

                                    {{$reviews->links('vendor.pagination.custom')}}
                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                            &quot;nav&quot;: false,
                            &quot;dots&quot;: true,
                            &quot;margin&quot;: 20,
                            &quot;loop&quot;: false,
                            &quot;responsive&quot;: {
                                &quot;0&quot;: {
                                    &quot;items&quot;:1
                                },
                                &quot;480&quot;: {
                                    &quot;items&quot;:2
                                },
                                &quot;768&quot;: {
                                    &quot;items&quot;:3
                                },
                                &quot;992&quot;: {
                                    &quot;items&quot;:4
                                },
                                &quot;1200&quot;: {
                                    &quot;items&quot;:4,
                                    &quot;nav&quot;: true,
                                    &quot;dots&quot;: false
                                }
                            }
                        }">
                        <!-- End .product -->

                        <!-- End .product -->

                        <!-- End .product -->

                        <!-- End .product -->

                        <!-- End .product -->
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-355px, 0px, 0px); transition: all 0s ease 0s; width: 1775px;">
                                @foreach ($products->related_products as $item )
                                    @if ($item->id  != $products->id)
                                        <div class="owl-item" style="width: 335px; margin-right: 20px;">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <span class="product-label label-sale">{{$item->conditions}}</span>
                                                    <a href="{{route('product.detail',$item->slug)}}">
                                                        <img src="/product_images/{{ $item->images[0]->image }}" alt="Product image" style="height: 300px;width: 100%;" class="product-image">
                                                         <img src="/product_images/{{ $item->images[1]->image }}" alt="Product image" class="product-image-hover">
                                                    </a>

                                                    <div class="product-action-vertical">
                                                        <a href="#"  data-quantity="1" data-id="{{$item->id}}" id="add_to_wishlist_{{$item->id}}"  class="add_to_wishlist btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                    </div><!-- End .product-action-vertical -->

                                                    <div class="product-action">
                                                        <a href="#" data-quantity="1" data-product-id = "{{$item->id}}" id="add-to-cart{{$item->id}}" class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>

                                                    </div><!-- End .product-action -->
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a href="#">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title"><a href="{{route('product.detail',$item->slug)}}">{{$item->title}}</a></h3><!-- End .product-title -->
                                                    <div class="product-price">
                                                        <span class="new-price"><del>{{Helper::currency_converter($item->price)}}</del></span>
                                                        <span class="old-price">{{Helper::currency_converter($item->offer_price)}}</span>
                                                    </div><!-- End .product-price -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

            <div class="owl-nav disabled">
                <button type="button" role="presentation" class="owl-prev"><i class="icon-angle-left"></i></button>
                <button type="button" role="presentation" class="owl-next disabled"><i class="icon-angle-right"></i></button></div>
                    <button role="button" class="owl-dot"><span></span></button>
                </div>
            </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main>
        <!-- End .main -->

       @include('WebSite.layouts.footer')

    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.add_delete_wishlist')
    @include('WebSite.layouts.auto_search')

    <script>
        document.addEventListener('click', function (event) {
        var addToCartButton = event.target.closest('.add_to_cart');

        if (addToCartButton) {
            event.preventDefault();

            var product_id = addToCartButton.getAttribute('data-product-id');
            var product_qty ;
            // var product_qty = addToCartButton.getAttribute('data-quantity');

            var quantityInput = document.querySelector('input[name="quantity"]');
            if(quantityInput){
                var product_qty = quantityInput.value;
            }
            var token = "{{ csrf_token() }}";
            var path = "{{route('cart.store')}}";
            var xhr = new XMLHttpRequest();

            xhr.open('POST', path, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-Token', token);

            xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        // Restore the button text
                        addToCartButton.innerHTML = '<span>add to cart</span>';

                        if (xhr.status === 200) {
                            try {
                            var data = JSON.parse(xhr.responseText);

                            document.getElementById('header-ajax').innerHTML = data.header;
                            if (data.status) {
                                swal({
                                        title: "Good Job!",
                                        text: data.message,
                                        icon: "success",
                                        button: "OK!"
                                });
                            }
                        } catch (error) {
                             console.error('Error parsing JSON response:', error);
                        }
                    }
                }
            };

            addToCartButton.innerHTML = '<i style="margin-right: 5px;" class="fa fa-spinner fa-spin"></i>Loading.....';

                var requestData = 'product_id=' + encodeURIComponent(product_id) + '&product_qty=' + encodeURIComponent(product_qty);

                xhr.send(requestData);
            }

        });

document.addEventListener('click', function (event) {
    var cartDeleteButton = event.target.closest('.cart_delete');

    if (cartDeleteButton) {
        event.preventDefault();

        var cartId = cartDeleteButton.getAttribute('data-id');

        var token = "{{ csrf_token() }}";
        var path = "{{route('cart.delete')}}";
        var xhr = new XMLHttpRequest();

        xhr.open('POST', path, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-CSRF-Token', token);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('header-ajax').innerHTML = data.header;

                        if (data.status) {
                            swal({
                                title: "Good Job!",
                                text: data.message,
                                icon: "success",
                                button: "OK!"
                            });
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                }
            }
        };

        var requestData = 'cart_id=' + encodeURIComponent(cartId) + '&_token=' + encodeURIComponent(token);

        xhr.send(requestData);
    }
});

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stars = document.querySelectorAll('.star');

            stars.forEach(function(star) {
                star.addEventListener('click', function() {
                    var starValue = this.dataset.value;
                    stars.forEach(function(s) {
                        s.classList.remove('fas');
                        s.classList.add('far');
                        if (s.dataset.value <= starValue) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        }
                    });

                    // إضافة القيمة إلى الإدخال المخفي لتخزينها مع النموذج
                    document.getElementById('rating').value = starValue;
                });
            });
        });
    </script>
    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            event.preventDefault(); // منع تحميل الصفحة بشكل تلقائي عند الضغط على الزر

            var formData = new FormData(this); // جمع بيانات النموذج

            var token = "{{ csrf_token() }}";
            var path = "{{ route('product.review', $products->slug) }}";
            var xhr = new XMLHttpRequest();

            xhr.open('POST', path, true);
            xhr.setRequestHeader('X-CSRF-Token', token);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var data = JSON.parse(xhr.responseText);

                            if (data.status) {
                                swal({
                                    title: "Good Job!",
                                    text: data.message,
                                    icon: "success",
                                    button: "OK!"
                                });
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    }
                }
            };

            var productReviewElement = document.getElementById("product-review-link");
            var reviewDivElement = document.getElementById("review_div");

            Promise.all([
                fetch(window.location.href, { method: 'GET' }),
                fetch(window.location.href, { method: 'GET' })
            ])
                .then(responses => {
                    return Promise.all(responses.map(response => response.text()));
                })
                .then(dataArray => {
                    var tempDiv1 = document.createElement('div');
                    var tempDiv2 = document.createElement('div');

                    tempDiv1.innerHTML = dataArray[0];
                    tempDiv2.innerHTML = dataArray[1];

                    var productReviewDetails = tempDiv1.querySelector("#product-review-link").innerHTML;
                    var reviewDivElementDetails = tempDiv2.querySelector("#review_div").innerHTML;

                    productReviewElement.innerHTML = productReviewDetails;
                    reviewDivElement.innerHTML = reviewDivElementDetails;
                })
                .catch(error => console.error('Error fetching data:', error));



            xhr.send(formData);
        });

    </script>

    @include('WebSite.layouts.mobil-menu')
    @include('WebSite.layouts.add_delete_compare')

    @include('WebSite.layouts.footer-scripts')
</body>


</html>
