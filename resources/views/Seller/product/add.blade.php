@extends('Seller.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Backend_Files/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('Backend_Files/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <!-- Internal Select2 css -->
    <link href="{{URL::asset('Backend_Files/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('Backend_Files/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Backend_Files/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Backend_Files/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('Backend_Files/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

    @section('title')
        Add Product
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Product Management</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
               Add Product</span>
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
                    <form action="{{ route('SellersProducts.store') }}" method="post" autocomplete="off"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        title
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="title" type="text" autofocus>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        summary
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="summary" type="text" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        description
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="description" type="text" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        stock
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required name="stock" type="number" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        price
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required name="price" type="number" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        discount
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required name="discount" type="number" autofocus/>
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
                                            <option value="{{$brand->id}}">{{$brand->title}}</option>
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
                            <div id="child_cat_div" class="row d-none  row-xs align-items-center mg-b-20">
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
                                        <option value="S">Small</option>
                                        <option value='M'>Medium</option>
                                        <option value="L">Large</option>
                                        <option value="XL">Extra Large</option>
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
                                        <option value="new">New</option>
                                        <option value="popular">Popular</option>
                                        <option value="winter">Winter</option>
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
{{--                                            <option value="{{$vendor->id}}">{{$vendor->full_name}}</option>--}}
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
                                    <input class="form-control" name="additional_info" type="text" autofocus/>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        Return&Cancellation
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="return_cancellation" type="text" autofocus/>
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
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
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
                                    <div style="margin-top: 15px" id="output1"></div>
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
                                    <div style="margin-top: 15px" id="output2"></div>
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


    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Backend_Files/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Backend_Files/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Backend_Files/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Backend_Files/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('Backend_Files/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('Backend_Files/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('Backend_Files/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('Backend_Files/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('Backend_Files/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('Backend_Files/js/form-elements.js')}}"></script>

@endsection
