@extends('Backend.layouts.master')

    @section('title')
        Add Banner
    @stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Banner Management</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
               Add Banner</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Backend.messages_alert')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('Banners.store')}}" method="post" autocomplete="off"
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
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        condition
                                    </label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="condition" class="form-control SlectBox">
                                        <option value="" selected disabled>Choose the condition</option>
                                        <option value="banner">banner</option>
                                        <option value="promo">promo</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        Upload
                                    </label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="image" onchange="loadFiles(event)">
                                    <div id="output"></div>
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
            var output = document.getElementById('output');
            output.innerHTML = ''; // مسح الصور السابقة إذا وجدت

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

                    output.appendChild(imgElement);
                };

                reader.readAsDataURL(files[i]);
            }
        };
    </script>


@endsection
