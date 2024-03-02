<!DOCTYPE html>
<html lang="en">
@section('title')
    About Us
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
        <div class="page-header text-center" style="background-image: url('WebSite/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">About us</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="about-text text-center mt-3">
                            <h2 class="title text-center mb-2">{{$aboutus->heading}}</h2><!-- End .title text-center mb-2 -->
                            <p>{{$aboutus->content}} </p>
                            <img src="{{asset('WebSite/assets/images/about/about-2/signature.png')}}" alt="signature" class="mx-auto mb-5">

                            <img src="/about_image/{{$aboutus->image}}" alt="image" class="mx-auto mb-6">
                        </div><!-- End .about-text -->
                    </div><!-- End .col-lg-10 offset-1 -->
                </div><!-- End .row -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-puzzle-piece"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Design Quality</h3><!-- End .icon-box-title -->
                                <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero <br>eu augue.</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-life-ring"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->
                                <p>Praesent dapibus, neque id cursus faucibus, <br>tortor neque egestas augue, eu vulputate <br>magna eros eu erat. </p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-heart-o"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Made With Love</h3><!-- End .icon-box-title -->
                                <p>Pellentesque a diam sit amet mi ullamcorper <br>vehicula. Nullam quis massa sit amet <br>nibh viverra malesuada.</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-2"></div><!-- End .mb-2 -->

            <div class="bg-image pt-7 pb-5 pt-md-12 pb-md-9" style="background-image: url(WebSite/assets/images/backgrounds/bg-4.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="count-container text-center">
                                <div class="count-wrapper text-white">
                                    <span class="count" data-from="0" data-to="{{$aboutus->happy_customer}}" data-speed="3000" data-refresh-interval="50">0</span>k+
                                </div><!-- End .count-wrapper -->
                                <h3 class="count-title text-white">Happy Customer</h3><!-- End .count-title -->
                            </div><!-- End .count-container -->
                        </div><!-- End .col-6 col-md-3 -->

                        <div class="col-6 col-md-3">
                            <div class="count-container text-center">
                                <div class="count-wrapper text-white">
                                    <span class="count" data-from="0" data-to="{{$aboutus->experience}}" data-speed="3000" data-refresh-interval="50">0</span>+
                                </div><!-- End .count-wrapper -->
                                <h3 class="count-title text-white">Years in Business</h3><!-- End .count-title -->
                            </div><!-- End .count-container -->
                        </div><!-- End .col-6 col-md-3 -->

                        <div class="col-6 col-md-3">
                            <div class="count-container text-center">
                                <div class="count-wrapper text-white">
                                    <span class="count" data-from="0" data-to="{{$aboutus->return_customer}}" data-speed="3000" data-refresh-interval="50">0</span>%
                                </div><!-- End .count-wrapper -->
                                <h3 class="count-title text-white">Return Clients</h3><!-- End .count-title -->
                            </div><!-- End .count-container -->
                        </div><!-- End .col-6 col-md-3 -->

                        <div class="col-6 col-md-3">
                            <div class="count-container text-center">
                                <div class="count-wrapper text-white">
                                    <span class="count" data-from="0" data-to="{{$aboutus->award_won}}" data-speed="3000" data-refresh-interval="50">0</span>
                                </div><!-- End .count-wrapper -->
                                <h3 class="count-title text-white">Awards Won</h3><!-- End .count-title -->
                            </div><!-- End .count-container -->
                        </div><!-- End .col-6 col-md-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .bg-image pt-8 pb-8 -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="brands-text text-center mx-auto mb-6">
                            <h2 class="title">The world's premium design brands in one destination.</h2><!-- End .title -->
                            <p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nis</p>
                        </div><!-- End .brands-text -->
                        <div class="brands-display">
                            <div class="row justify-content-center">
                                @if(count($brands) > 0)
                                    @foreach($brands as $brand)
                                        <div class="col-6 col-sm-4 col-md-3">
                                            <a href="#" class="brand">
                                                <img src="/brand_images/{{$brand->photo}}" alt="Brand Name">
                                            </a>
                                        </div><!-- End .col-md-3 -->
                                    @endforeach
                                @endif
                            </div><!-- End .row -->
                        </div><!-- End .brands-display -->
                    </div><!-- End .col-lg-10 offset-lg-1 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

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



