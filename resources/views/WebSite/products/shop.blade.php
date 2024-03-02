@php use App\Models\Brand; @endphp
@php use App\Models\Product; @endphp
    <!DOCTYPE html>
<html lang="en">
@section('title')
    Shop
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
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <form action="{{route('shop.filter')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9 col-xl-4-5col">


                            <div class="toolbox">
                                <div class="toolbox-left">
                                    <div class="toolbox-info">
                                        {{count($products)}} Products found
                                    </div><!-- End .toolbox-info -->
                                </div><!-- End .toolbox-left -->

                                <div class="toolbox-right">
                                    <div class="toolbox-sort">
                                        <label for="sortby">Sort by:</label>
                                        <div class="select-custom">
                                            <select name="sortby" id="sortby" onchange="this.form.submit()"
                                                    class="form-control">
                                                <option selected>Default</option>
                                                <option value="priceAsc" {{$sort == 'priceAsc' ? 'selected': '' }}>Price
                                                    - Lower To Higher
                                                </option>
                                                <option value="priceDesc" {{$sort == 'priceDesc' ? 'selected': '' }}>
                                                    Price - Higher To Lower
                                                </option>
                                                <option value="titleAsc" {{$sort == 'titleAsc' ? 'selected': '' }}>
                                                    Alphabetical Ascending
                                                </option>
                                                <option value="titleDesc" {{$sort == 'titleDesc' ? 'selected': '' }} >
                                                    Alphabetical Descending
                                                </option>
                                                <option value="discAsc" {{$sort == 'discAsc' ? 'selected': '' }}>
                                                    Discount - Lower To Higher
                                                </option>
                                                <option value="discDesc" {{$sort == 'discDesc' ? 'selected': '' }}>
                                                    Discount - Higher To Lower
                                                </option>
                                            </select>
                                        </div>
                                    </div><!-- End .toolbox-sort -->
                                </div><!-- End .toolbox-right -->
                            </div><!-- End .toolbox -->

                            <div class="products mb-3">
                                <div class="row">
                                    @if(count($products) > 0)
                                        @foreach($products as $item)
                                            @include('WebSite.layouts.Product_Card')
                                        @endforeach
                                    @else
                                        <p>No Product Found</p>
                                    @endif

                                </div><!-- End .row -->
                            </div><!-- End .products -->

                            {{$products->appends($_GET)->links('vendor.pagination.custom')}}
                        </div><!-- End .col-lg-9 -->

                        <aside class="col-lg-3 col-xl-5col order-lg-first">

                            <div class="sidebar sidebar-shop">
                                <div class="widget">
                                    <h3 class="widget-title">Product Categories</h3><!-- End .widget-title -->

                                    @if(!empty($_GET['category']))
                                        @php
                                            $filter_cats = explode(',' , $_GET['category']);
                                        @endphp
                                    @endif
                                    <div class="widget-body">
                                        @foreach($cats as $cat)
                                            <div class="filter-items">
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               @if(!empty($filter_cats) && in_array($cat->slug , $filter_cats)) checked
                                                               @endif class="custom-control-input" id="{{$cat->slug}}"
                                                               name="category[]" value="{{$cat->slug}}"
                                                               onchange="this.form.submit()">
                                                        <label class="custom-control-label"
                                                               for="{{$cat->slug}}">{{$cat->title}}
                                                            ({{count($cat->products)}})</label>
                                                    </div><!-- End .custom-checkbox -->
                                                </div><!-- End .filter-item -->
                                            </div><!-- End .filter-items -->
                                        @endforeach
                                    </div><!-- End .widget-body -->
                                </div><!-- End .widget -->

                                <div class="widget">
                                    <h3 class="widget-title">Price</h3><!-- End .widget-title -->

                                    @if(!empty($_GET['range_price']))
                                        @php
                                            $filter_price = $_GET['range_price'];
                                            $max_price = Product::max('offer_price');
                                        @endphp
                                    @endif
                                    <div class="widget-body">
                                        <div class="filter-items">

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        @if(!empty($filter_price) && $filter_price =='25-50') checked
                                                        @endif
                                                        type="radio" onchange="this.form.submit()"
                                                           class="custom-control-input" id="price-2" value="25-50"
                                                           name="range_price">
                                                    <label class="custom-control-label" for="price-2">$25 to $50</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        @if(!empty($filter_price) && $filter_price =='50-100') checked
                                                        @endif
                                                        type="radio" onchange="this.form.submit()"
                                                           class="custom-control-input" id="price-3" value="50-100"
                                                           name="range_price">
                                                    <label class="custom-control-label" for="price-3">$50 to
                                                        $100</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        @if(!empty($filter_price) && $filter_price =='100-200') checked
                                                        @endif
                                                        type="radio" onchange="this.form.submit()"
                                                           class="custom-control-input" id="price-4" value="100-200"
                                                           name="range_price">
                                                    <label class="custom-control-label" for="price-4">$100 to
                                                        $200</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           @if(!empty($filter_price) && $filter_price =='200-'.$max_price ) checked
                                                           @endif  onchange="this.form.submit()"
                                                           class="custom-control-input" id="price-5"
                                                           value="200-{{Product::max('offer_price')}}"
                                                           name="range_price">
                                                    <label class="custom-control-label" for="price-5">$200 &
                                                        Above</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .widget -->

                                <div class="widget">
                                    <h3 class="widget-title">Brands</h3><!-- End .widget-title -->

                                    @if(!empty($_GET['brand']))
                                        @php
                                            $filter_brand = explode(',' , $_GET['brand']);
                                        @endphp
                                    @endif
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach($brands as $brand)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               @if(!empty($filter_brand) && in_array($brand->slug , $filter_brand))
                                                                   checked
                                                               @endif class="custom-control-input" id="{{$brand->slug}}"
                                                               name="brand[]"
                                                               value="{{$brand->slug}}"
                                                               onchange="this.form.submit()">
                                                        <label class="custom-control-label"
                                                               for="{{$brand->slug}}">{{$brand->title}}
                                                            ({{count($brand->products)}})
                                                        </label>
                                                    </div><!-- End .custom-checkbox -->
                                                </div><!-- End .filter-item -->
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .widget -->

                                <div class="widget">
                                    <h3 class="widget-title">Size</h3><!-- End .widget-title -->

                                    @if(!empty($_GET['size']))
                                        @php
                                            $filter_size = explode(',' , $_GET['size']);
                                        @endphp
                                    @endif
                                    <div class="widget-body">
                                        <div class="filter-items">
                                                <div class="filter-item">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio"
                                                               @if(!empty($filter_size) && in_array('S' , $filter_size))
                                                                   checked
                                                               @endif class="custom-control-input" id="smallcheckout"
                                                               name="size"
                                                               value="S"
                                                               onchange="this.form.submit()">
                                                        <label class="custom-control-label"
                                                               for="smallcheckout">Small
                                                            ({{\App\Models\Product::where(['status' => 'active' ,'size'=> 'S' ])->count()}})
                                                        </label>
                                                    </div><!-- End .custom-checkbox -->
                                                </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           @if(!empty($filter_size) && in_array('M' , $filter_size))
                                                               checked
                                                           @endif class="custom-control-input" id="mediumcheckout"
                                                           name="size"
                                                           value="M"
                                                           onchange="this.form.submit()">
                                                    <label class="custom-control-label"
                                                           for="mediumcheckout">Medium
                                                        ({{\App\Models\Product::where(['status' => 'active' ,'size'=> 'M' ])->count()}})
                                                    </label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           @if(!empty($filter_size) && in_array('L' , $filter_size))
                                                               checked
                                                           @endif class="custom-control-input" id="largecheckout"
                                                           name="size"
                                                           value="L"
                                                           onchange="this.form.submit()">
                                                    <label class="custom-control-label"
                                                           for="largecheckout">Large
                                                        ({{\App\Models\Product::where(['status' => 'active' ,'size'=> 'L' ])->count()}})
                                                    </label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                            <div class="filter-item">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           @if(!empty($filter_size) && in_array('XL' , $filter_size))
                                                               checked
                                                           @endif class="custom-control-input" id="xlargecheckout"
                                                           name="size"
                                                           value="S"
                                                           onchange="this.form.submit()">
                                                    <label class="custom-control-label"
                                                           for="xlargecheckout">EXtra Large
                                                        ({{\App\Models\Product::where(['status' => 'active' ,'size'=> 'XL' ])->count()}})
                                                    </label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .widget -->


                            </div><!-- End .sidebar sidebar-shop -->
                        </aside><!-- End .col-lg-3 -->

                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .page-content -->

    </main><!-- End .main -->
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
