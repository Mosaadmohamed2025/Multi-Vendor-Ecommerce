<!DOCTYPE html>
<html lang="en">
@section('title')
    Compare
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
        <div class="page-header text-center" style="background-image: url('{{asset('WebSite/assets/images/page-header-bg.jpg')}}')">
            <div class="container">
                <h1 class="page-title">compare<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">compare</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="table-responsive">
                    <table class="table table-compare overflow-auto table-mobile">
                        <thead>
                        <tr>
                            <th style="width: 130px"> Image</th>
                            <th style="width: 130px"> Name</th>
                            <th style="width: 130px">Rating</th>
                            <th style="width: 130px">Price</th>
                            <th style="width: 250px">Description</th>
                            <th style="width: 130px">Brand</th>
                            <th style="width: 130px">Availabilty</th>
                            <th style="width: 130px">Size</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody id="body-compare">
                        @include('WebSite.layouts.compare_list')
                        </tbody>
                    </table><!-- End .table table-compare -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main>
    @include('WebSite.layouts.footer')

</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

@include('WebSite.layouts.mobil-menu')


@include('WebSite.layouts.add_delete_compare')
@include('WebSite.layouts.add_delete_cart')
@include('WebSite.layouts.auto_search')
@include('WebSite.layouts.footer-scripts')
</body>
</html>



