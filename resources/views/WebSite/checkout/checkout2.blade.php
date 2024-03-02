<!DOCTYPE html>
<html lang="en">
@section('title')
 checkout
@stop
@include('WebSite.layouts.head')
<body>
    <div class="page-wrapper">
        @include('WebSite.layouts.header')
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
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
        <div class="page-header text-center" style="background-image: url('{{asset('WebSite/assets/images/page-header-bg.jpg')}}')">
            <div class="container">
                <h1 class="page-title">Shippings<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shippings</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <form action="{{route('checkout2.store')}}" method="POST">

                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Method</th>
                                            <th>Delivery Time</th>
                                            <th>Price</th>
                                            <th>Choose</th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-cart">
                                        @if (count($shippings) > 0)
                                        @foreach ($shippings as $key => $item)
                                            <tr>
                                                <td class="product-col">
                                                {{$item->shipping_address}}
                                                </td>
                                                <td class="quantity-col">
                                                    <div style="text-align: center" class=" cart-product-quantity">
                                                        <span>{{$item->delivery_time}}</span>
                                                    </div><!-- End .cart-product-quantity -->
                                                </td>
                                                <td class="price-col">{{Helper::currency_converter($item->delivery_charge)}}</td>
                                                <td class="total-col">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio{{$key}}" value="{{$item->delivery_charge}}"  name="delivery_charge" class="custom-control-input" />
                                                        <label for="customRadio{{$key}}" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <td colspan="3" >No Shipping Method found !</td>
                                        @endif
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</td>
                                            </tr><!-- End .summary-subtotal -->
                                            <tr>
                                                <td>Save Amount:</td>
                                                <td>
                                                    @if (session()->has('coupon'))
                                                        {{Helper::currency_converter(session('coupon')['value'])}}
                                                    @else
                                                        {{Helper::currency_converter(0)}}
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $floatValue = floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal()));
                                                $formattedValue = number_format($floatValue, 2, '.', ''); // يحفظ رقمين بعد الفاصلة ويزيل الفواصل
                                            @endphp
                                            <tr class="summary-total">
                                                <td>Total:</td>

                                                @if(session()->has('coupon')&& $formattedValue > 0)

                                                    <td>{{Helper::currency_converter($formattedValue - session('coupon')['value'])}}</td>
                                                @else
                                                    <td>{{Helper::currency_converter(\Gloudemans\Shoppingcart\Facades\Cart::subtotal())}}</td>
                                                @endif
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->


                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Continue</span>
                                        <span class="btn-hover-text">Go To Checkout Method</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main>
        <!-- End .main -->

       @include('WebSite.layouts.footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.mobil-menu')

    @include('WebSite.layouts.add_delete_cart')

    @include('WebSite.layouts.auto_search')

    @include('WebSite.layouts.footer-scripts')
</body>


</html>



