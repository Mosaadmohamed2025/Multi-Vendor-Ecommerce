@php use App\Models\Category; @endphp
<header class="header header-6" id="header-ajax">
    <div class="header-top" style="padding: 15px">
        <div class="container">
            <div class="header-left">
                <ul class="top-menu top-link-menu d-none d-md-block">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="social-icons social-icons-color">
                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon social-pinterest" title="Instagram" target="_blank"><i class="icon-pinterest-p"></i></a>
                    <a href="#" class="social-icon social-instagram" title="Pinterest" target="_blank"><i class="icon-instagram"></i></a>
                </div><!-- End .soial-icons -->
                <ul class="top-menu top-link-menu">
                    <li>
                       @if (!Auth::check())
                       <ul>
                           <li><a href="{{ route('user.auth') }}"><i class="icon-user"></i>Login</a></li>
                       </ul>
                       @endif
                    </li>
                </ul><!-- End .top-menu -->



                @auth
                <div style="display: block !important;" class="header-dropdown">
                    @if (auth()->user()->photo)
                    <a href="#"><img style="width: 40px; border-radius: 50%;border:1px solid #cd9966" src="/user_images/{{auth()->user()->photo}}" /></a>
                    @else
                    <a href="#"><img style="width: 40px; border-radius: 50%;border:1px solid #cd9966" src="{{ asset('WebSite/assets/images/testimonials/user-1.jpg') }}" /></a>
                    @endif

                    <div class="header-menu" style="padding: 5px">
                        @php
                            $first_name = explode(' ', auth()->user()->full_name);
                        @endphp
                        <ul>
                            <li><a><span>Hello,</span>{{$first_name[0]}}!</a></li>
                            <li><a href="{{route('user.dashboard')}}"><i style="margin-right: 5px;" class="fas fa-user-circle"></i> My Account</a></li>
                            <li><a href="{{route('user.logout')}}"><i   style="margin-right: 5px;" class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
                @endauth


                @php
                Helper::currency_load();
                $currency_code = session('currency_code');
                $currency_symbol = session('currency_symbol');

                if($currency_symbol == "")
                    {
                        $system_default_currency_info = session('system_default_currency_info');
                        $currency_symbol = $system_default_currency_info->symbol;
                        $currency_code = $system_default_currency_info->code;
                    }
                @endphp
                <div  style="display: block !important;" class="header-dropdown">
                    <a href="#">
                        {{$currency_symbol}} {{$currency_code}}
                    </a>
                    <div class="header-menu">
                        <ul>
                            @foreach(\App\Models\Currency::where('status' , 'active')->get() as $currency)
                                <li><a href="javascript:;" onclick="currency_change('{{$currency['code']}}')">{{$currency->symbol}} {{\Illuminate\Support\Str::upper($currency->code)}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End .header-menu -->
                </div>
            </div><!-- End .header-right -->
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{route('search')}}" method="GET">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            <input id="search_text"  type="search" value="" class="form-control" name="query"  placeholder="Search product ..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                    <div style="width: 300px  !important;  position: absolute ; top: 65px;z-index: 1000">
                        <select style="color: #0c0b0b;height: 200px !important; display: none" id="search_results_dropdown"></select>
                    </div>

                </div><!-- End .header-search -->
            </div>
            <div class="header-center">
                <a href="{{route('home')}}" class="logo">
                    <img src="/logo_image/{{\App\Models\Settings::value('logo')}}" alt="Molla Logo" width="82" height="20">
                </a>
            </div><!-- End .header-left -->

            <div class="header-right">
                <a href="{{route('compare')}}" class="wishlist-link">
                    <i class="icon-random"></i>
                    <span id="wish_list" class="wishlist-count">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count()}}</span>
                </a>

                <a href="{{route('wishlist')}}" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <span id="wish_list" class="wishlist-count">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()}}</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span id="cart-count" class="cart-count">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count()}}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="{{ route('product.detail', isset($item->options['slug']) ? $item->options['slug'] : 1) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">{{$item->qty}}</span>
                                        x {{Helper::currency_converter($item->price)}}
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="{{ route('product.detail', $item->model->slug) }}" class="product-image">
                                        <img src="/product_images/{{$item->model->images[0]->image}}" alt="product">
                                    </a>
                                    </figure>
                                <a href="#" data-id="{{$item->rowId}}" class="btn-remove cart_delete" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->
                            @endforeach
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Sub Total</span>

                            @php
                            $floatValue = floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal()));
                            $formattedValue = number_format($floatValue, 2, '.', ''); // يحفظ رقمين بعد الفاصلة ويزيل الفواصل
                            @endphp
                            <span class="cart-total-price">{{Helper::currency_converter($formattedValue)}}</span>
                        </div><!-- End .dropdown-cart-total -->
                        <div class="dropdown-cart-total">
                            <span> Total</span>

                            @if(session()->has('coupon')&& $formattedValue > 0)

                            <span class="cart-total-price">{{Helper::currency_converter($formattedValue - session('coupon')['value'])}}</span>
                            @else
                            <span class="cart-total-price">{{Helper::currency_converter(\Gloudemans\Shoppingcart\Facades\Cart::subtotal())}}</span>
                            @endif
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
                            <a href="{{route('checkout1')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container">
                            <a href="{{route('home')}}" >Home</a>
                        </li>
                        <li>
                            <a href="{{route('shop')}}">Shop</a>
                        </li>

                        @php
                            $header_categories = Category::where(['status'=> 'active' , 'is_parent' => 1])->orderBy('id', 'desc')->limit('3')->get();
                        @endphp
                        <li>
                            <a href="#" class="sf-with-ul">Category</a>

                            <ul>
                                @if (count($header_categories) > 0)
                                    @foreach ( $header_categories as $category)
                                        <li><a href="{{route('product.category', $category->slug)}}">{{$category->title}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('aboutus')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route('contactus')}}">Contact</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->

                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
            </div><!-- End .header-left -->

            <div class="header-right">
                <i class="la la-lightbulb-o"></i><p>Clearance Up to 30% Off</p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
