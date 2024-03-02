<!DOCTYPE html>
<html lang="en">
@section('title')
 complete
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
    <main style="padding: 15px;" class="main">

        <div class="page-content">
                <div class="container">
                 <div  style="
                 border: 5px solid #c96;
                 margin: auto;
                 padding: 15px;"

                 >
                    <p style="font-size: 25px">Thank you for your order</p>
                    <p  style="font-size: 25px">your order number is: </p><span style="color: #c96;font-size: 20px">{{$order}}</span>
                 </div>
                </div><!-- End .container -->
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
    @include('WebSite.layouts.auto_search')

    @include('WebSite.layouts.add_delete_cart')


    @include('WebSite.layouts.footer-scripts')
</body>


</html>



