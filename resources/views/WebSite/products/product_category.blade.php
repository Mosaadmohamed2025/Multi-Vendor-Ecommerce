<!DOCTYPE html>
<html lang="en">
@section('title')
Product Category
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
        <main class="main" style="padding-top: 30px">
            <div class="page-content">
                <div style="position: relative" class="container">
                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select style="padding: 5px;" id="sortBy" class="small right">
                                        <option selected>Default</option>
                                        <option value="priceAsc" {{$sort == 'priceAsc' ? 'selected': '' }}>Price - Lower To Higher</option>
                                        <option value="priceDesc" {{$sort == 'priceDesc' ? 'selected': '' }}>Price - Higher To Lower</option>
                                        <option value="titleAsc" {{$sort == 'titleAsc' ? 'selected': '' }}>Alphabetical Ascending</option>
                                        <option value="titleDesc" {{$sort == 'titleDesc' ? 'selected': '' }} >Alphabetical Descending</option>
                                        <option value="discAsc" {{$sort == 'discAsc' ? 'selected': '' }}>Discount  -  Lower To Higher</option>
                                        <option value="discDesc" {{$sort == 'discDesc' ? 'selected': '' }}>Discount - Higher To Lower</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <h2 class="title text-center mb-3">{{$product_category->title}}</h2><!-- End .title -->


                    @if (count($products) > 0)
                        <div class="products">
                            <div class="row justify-content-center">
                                @foreach ($products as $item )
                                    @include('WebSite.layouts.Product_Card')
                                @endforeach
                            </div>
                        </div>

                    <hr class="mt-0 mb-5">
                    @endif
                </div><!-- End .container -->

            </div><!-- End .page-content -->

        </main>

       @include('WebSite.layouts.footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('WebSite.layouts.mobil-menu')


    <script>
            document.getElementById('sortBy').addEventListener('change', function() {
                var sort = document.getElementById('sortBy').value;

                window.location = "{{ url('') }}/" + "{{$route}}" + "/" + "{{$categories->slug}}" + "?sort=" + sort;
        });

    </script>

    @include('WebSite.layouts.add_delete_wishlist')

    @include('WebSite.layouts.add_delete_cart')

    @include('WebSite.layouts.auto_search')


    @include('WebSite.layouts.footer-scripts')


</body>

</html>
