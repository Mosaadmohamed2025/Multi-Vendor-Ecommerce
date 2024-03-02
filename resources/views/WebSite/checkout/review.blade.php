<!DOCTYPE html>
<html lang="en">
@section('title')
 review
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
                <h1 class="page-title">Review Your Order<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="body-cart">
                                 @include('WebSite.layouts.cart_list')
                                </tbody>
                            </table><!-- End .table table-wishlist -->

                        </div><!-- End .col-lg-9 -->
                        <aside id="cart_information"  class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

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
                                        <tr class="summary-subtotal">
                                            <td>Shipping:</td>
                                            <td>{{Helper::currency_converter(session('checkout')[0]['delivery_charge'], 2)}}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        @if (session()->has('coupon'))
                                        <tr>
                                            <td>Coupon:</td>
                                            <td>{{Helper::currency_converter(session('coupon')['value'])}}</td>
                                        </tr>
                                        @endif

                                        @php
                                        $floatValue = floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal()));
                                        $formattedValue = number_format($floatValue, 2, '.', ''); // يحفظ رقمين بعد الفاصلة ويزيل الفواصل
                                        @endphp
                                        <tr class="summary-total">
                                            <td>Total:</td>

                                            @if(session()->has('coupon') && session()->has('checkout'))
                                            <td>{{Helper::currency_converter(floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal())) + session('checkout')[0]['delivery_charge'] - session('coupon')['value'], 2 )}}</td>
                                            @elseif (session()->has('checkout'))
                                            <td>{{Helper::currency_converter(floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal())) + session('checkout')[0]['delivery_charge'], 2 )}}</td>
                                            @endif
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <a href="{{route('checkout.store')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main>
       @include('WebSite.layouts.footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.mobil-menu')

<script>
    document.addEventListener('click', function (e) {
        var couponButton = e.target.closest('.coupon-btn');

        if (couponButton) {
            e.preventDefault();

            var code = document.querySelector('input[name="code"]').value;
            couponButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Applying....';

            document.getElementById('coupon-form').submit();
        }
    });
</script>
<script>
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
                        document.getElementById('body-cart').innerHTML = data.cart_list;

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

        var cartInformationElement = document.getElementById("cart_information");
        fetch(window.location.href, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = data;

                var cartInformationdetails = tempDiv.querySelector("#cart_information").innerHTML;

                cartInformationElement.innerHTML = cartInformationdetails;
            })
            .catch(error => console.error('Error fetching data:', error));
    }
});
</script>

    @include('WebSite.layouts.auto_search')

    @include('WebSite.layouts.footer-scripts')
</body>


</html>



