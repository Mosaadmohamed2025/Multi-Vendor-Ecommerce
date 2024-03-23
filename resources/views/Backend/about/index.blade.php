@extends('Backend.layouts.master')

    @section('title')
    About Us
    @stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">About Us</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               Edit About</span>
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

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('About.update', 'test') }}" method="post" autocomplete="off"
                          enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        heading
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->heading}}" required
                                           name="heading" type="text" autofocus>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        content
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->content}}" required
                                           name="content" type="text" autofocus>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Experience
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->experience}}" required
                                           name="experience" type="number" autofocus>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Return Customer
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->return_customer}}" required
                                           name="return_customer" type="number" autofocus>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Happy Customer
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->happy_customer}}" required
                                           name="happy_customer" type="number" autofocus>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Award Won
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$aboutus->award_won}}" required
                                           name="award_won" type="number" autofocus>
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">
                                        image
                                    </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*"  name="image"
                                           onchange="loadFiles(event)">
                                    <div style="margin-top: 15px" id="output1">
                                        <img  src="/about_image/{{$aboutus->image}}" style="border-radius: 50%" width="150px" height="150px"  />
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit
                            </button>
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
@endsection
