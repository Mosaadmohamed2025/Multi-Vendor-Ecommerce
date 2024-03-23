@extends('Seller.layouts.master')

    @section('title')
        Update Product
    @stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Product Management</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
               Update Product</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('SellersProducts.update','test') }}" method="post" autocomplete="off"
                          enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        title
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="title" type="text" value="{{$product->title}}"
                                           autofocus>
                                    <input class="form-control" value="{{$product->id}}" name="id" type="hidden">

                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        summary
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="summary" value="{{$product->summary}}" type="text"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        description
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="description" value="{{$product->description}}"
                                           type="text" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        stock
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required value="{{$product->stock}}" name="stock"
                                           type="number" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        price
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required value="{{$product->price}}" name="price"
                                           type="number" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        discount
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$product->discount}}" name="discount"
                                           type="number" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Brands
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="brand_id" class="form-control SlectBox">
                                        <option selected disabled>Choose the brands</option>
                                        @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Category
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select id="cat_id" name="cat_id" class="form-control SlectBox">
                                        <option selected disabled>Choose the category</option>
                                        @foreach (\App\Models\Category::where('is_parent',1)->get() as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="child_cat_div" class="row  d-none row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Child Category
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select id="child_cat_id" name="child_cat_id" class="form-control SlectBox">
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Size
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="size" class="form-control SlectBox">
                                        <option selected disabled>Choose the size</option>
                                        <option value="S" {{$product->size == 'S' ? 'selected' : ''}}>Small</option>
                                        <option value='M' {{$product->size == 'M' ? 'selected' : ''}}>Medium</option>
                                        <option value="L" {{$product->size == 'L' ? 'selected' : ''}}>Large</option>
                                        <option value="XL" {{$product->size == 'XL' ? 'selected': ''}}>Extra Large
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Condition
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="conditions" class="form-control SlectBox">
                                        <option selected disabled>Choose the Conditions</option>
                                        <option value="new" {{$product->conditions == 'new' ? 'selected' : ''}}>New
                                        </option>
                                        <option value="popular" {{$product->conditions == 'popular' ? 'selected' : ''}}>
                                            Popular
                                        </option>
                                        <option value="winter" {{$product->conditions == 'Winter' ? 'selected' : ''}}>
                                            Winter
                                        </option>
                                    </select>
                                </div>
                            </div>
{{--                            <div class="row row-xs align-items-center mg-b-20">--}}
{{--                                <div class="col-md-1">--}}
{{--                                    <label for="exampleInputEmail1">--}}
{{--                                        Vendor--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-11 mg-t-5 mg-md-t-0">--}}
{{--                                    <select name="vendor_id" class="form-control SlectBox">--}}
{{--                                        <option selected disabled>Choose the Vendors</option>--}}
{{--                                        @foreach (\App\Models\User::where('role','vendor')->get() as $vendor)--}}
{{--                                            <option value="{{$vendor->id}}" {{$product->vendor_id == $vendor->id ? 'selected' : ''}}>{{$vendor->full_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Additional Info
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$product->additional_info}}"
                                           name="additional_info" type="text" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Return&Cancellation
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$product->return_cancellation}}"
                                           name="return_cancellation" type="text" autofocus/>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Status
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="status" class="form-control SlectBox">
                                        <option selected disabled>Choose the status</option>
                                        <option value="active" {{$product->status == 'active' ? 'selected' : ''}}>
                                            active
                                        </option>
                                        <option value="inactive" {{$product->status == 'inactive' ? 'selected' : ''}}>
                                            inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Upload Photos
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" multiple name="images[]"
                                           onchange="loadFiles(event)">
                                    <div style="margin-top: 15px" id="output1">
                                        @foreach ($product->images as $key => $image)
                                            <img  src="/product_images/{{$image->image}}" style="border-radius: 50%" width="150px" height="150px"  />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Size Guide
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" multiple name="size_guides[]"
                                           onchange="loadFiles2(event)">
                                    <div style="margin-top: 15px" id="output2">
                                        @foreach ($product->Size_Guide_images as $key => $image)
                                            <img  src="/product_images/{{$image->image}}" style="border-radius: 50%" width="150px" height="150px"  />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <script>
        var loadFiles = function (event) {
            var output1 = document.getElementById('output1');
            output1.innerHTML = ''; // مسح الصور السابقة إذا وجدت

            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var img = document.createElement('img');
                img.style.borderRadius = '50%';
                img.style.width = '150px';
                img.style.height = '150px';

                var reader = new FileReader();
                reader.onload = function (e) {
                    var imgElement = document.createElement('img');
                    imgElement.style.borderRadius = '50%';
                    imgElement.style.width = '150px';
                    imgElement.style.height = '150px';
                    imgElement.src = e.target.result;

                    output1.appendChild(imgElement);
                };

                reader.readAsDataURL(files[i]);
            }
        };
    </script>
    <script>
        var loadFiles2 = function (event) {
            var output2 = document.getElementById('output2');
            output2.innerHTML = ''; // مسح الصور السابقة إذا وجدت

            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var img = document.createElement('img');
                img.style.borderRadius = '50%';
                img.style.width = '150px';
                img.style.height = '150px';

                var reader = new FileReader();
                reader.onload = function (e) {
                    var imgElement = document.createElement('img');
                    imgElement.style.borderRadius = '50%';
                    imgElement.style.width = '150px';
                    imgElement.style.height = '150px';
                    imgElement.src = e.target.result;

                    output2.appendChild(imgElement);
                };

                reader.readAsDataURL(files[i]);
            }
        };
    </script>
    <script>
        $('#is_parent').change(function (e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');

            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>

    <script>

        $('#cat_id').change(function () {
            var cat_id = $(this).val();
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function (response) {
                        var Child_Category_Option = "<option  selected disabled>Choose the child category</option>";

                        if (response.status === true) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function (id, title) {
                                Child_Category_Option += "<option value='" + id + "'>" + title + "</option>";
                            })
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }

                        $('#child_cat_id').html(Child_Category_Option);
                    },
                });
            }
        });
    </script>
@endsection
