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
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                        <form action="">
                            <input type="text" class="form-control" required="" id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                        </form>
                    </div><!-- End .checkout-discount -->
                    @php
                    $name = explode(' ',$user->full_name);
                    @endphp
                    <form action="{{route('checkout1.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <input  type="hidden" name="sub_total"  value={{(float)str_replace(',' , '' , \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()) }}/>
                                            <input  type="hidden" name="total_amount"  value={{(float)str_replace(',' , '' , \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal())}}/>
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" value="{{$name[0]}}" required name="first_name" id="first_name">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" value="{{$name[1] ?? ''}}" required name="last_name" id="last_name" >
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Country *</label>
                                    <input type="text" class="form-control" name="country"  value="{{$user->country}}"  id="country">

                                    <label>Street address *</label>
                                    <input type="text" class="form-control" placeholder="House number and Street name" name="address" value="{{$user->address}}" required id="address">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" class="form-control" name="city" value="{{$user->city}}" required="" id="city">
                                        </div><!-- End .col-sm-6 -->
                                        <div class="knmknia">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>state *</label>
                                            <input type="text" class="form-control" name="state" value="{{$user->state}}"  id="state">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" class="form-control" name="postcode" value="{{$user->postcode}}" required id="postcode">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" value="{{$user->phone}}" class="form-control" required name="phone" id="phone">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Email address *</label>
                                    <input type="email" value="{{$user->email}}" class="form-control" readonly required name="email" id="email">

                                    <label>Order notes (optional)</label>
                                    <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery" name="note"></textarea>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkout-same-address">
                                        <label class="custom-control-label" for="checkout-same-address">Ship to a same address?</label>
                                    </div><!-- End .custom-checkbox -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control"  required name="sfirst_name" id="sfirst_name">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control"  required name="slast_name" id="slast_name">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Country *</label>
                                    <input type="text" class="form-control" name="scountry"   id="scountry">

                                    <label>Street address *</label>
                                    <input type="text" class="form-control" placeholder="House number and Street name" id="saddress" name="saddress" required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" class="form-control" name="scity" id="scity" required="">
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label>state *</label>
                                            <input type="text" class="form-control" id="sstate" name="sstate" >
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" class="form-control" id="spostcode" name="spostcode" >
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" id="sphone" class="form-control" required name="sphone" >
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Email address *</label>
                                    <input type="email" value="{{$user->email}}" class="form-control"  required name="semail" id="email">

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
                                                <td>{{Helper::currency_converter(\Gloudemans\Shoppingcart\Facades\Cart::subtotal())}}</td>
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
                                        <span class="btn-hover-text">Go To Shipping Page</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main>
        <!-- End .main -->

       @include('WebSite.layouts.footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.mobil-menu')

    <script>
        document.getElementById('checkout-same-address').addEventListener('change', function (e) {
                    e.preventDefault();

                    var billingElements = ['first_name', 'last_name', 'country', 'address', 'city', 'state', 'postcode', 'phone', 'email'];
                    var shippingElements = ['sfirst_name', 'slast_name', 'scountry', 'saddress', 'scity', 'sstate', 'spostcode', 'sphone'];

                    if (this.checked) {
                        for (var i = 0; i < billingElements.length; i++) {
                        var billingElement = document.getElementById(billingElements[i]);
                        var shippingElement = document.getElementById(shippingElements[i]);

                        if (billingElement && shippingElement) {
                          shippingElement.value = billingElement.value;
                        }
                        }
                    } else {
                    for (var i = 0; i < shippingElements.length; i++) {
                        var shippingElement = document.getElementById(shippingElements[i]);

                    if (shippingElement) {
                        shippingElement.value = "";
                    }
                }
            }
        });
    </script>

    @include('WebSite.layouts.add_delete_cart')

    @include('WebSite.layouts.auto_search')

    @include('WebSite.layouts.footer-scripts')
</body>


</html>



