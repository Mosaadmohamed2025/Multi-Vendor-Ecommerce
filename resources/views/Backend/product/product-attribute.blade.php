@extends('Backend.layouts.master')
@section('title')
    Product Attribute
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Product Management</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                      Product Attribute</span>
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
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{route('product.attribute',$product->id)}}" method="POST">
                            @csrf
                            <div id="product-attribute" class="content"
                                 data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <button type="button" id="btnAdd-1" class="btn btn-sm btn-primary"><i
                                                    style="color: white;" class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row group">
                                    <div class="col-md-2">
                                        <label>Size</label>
                                        <input class="form-control form-control-sm" name="size[]" type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Original Price</label>
                                        <input class="form-control form-control-sm" name="original_price[]" step="any"
                                               type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label>offer Price</label>
                                        <input class="form-control form-control-sm" name="offer_price[]" step="any"
                                               type="number">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Stock</label>
                                        <input class="form-control form-control-sm" name="stock[]" type="number">
                                    </div>
                                    <div class="col-md-1 m-1">
                                        <button type="button" class="btn btn-sm btn-danger btnRemove"><i
                                                    class="text-white  ti-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-info mt-1">Submit</button>

                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>size</th>
                                <th>original</th>
                                <th>offer</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($product_attributes) > 0)
                                @foreach($product_attributes as $item)
                                    <tr>
                                        <td>{{$item->size}}</td>
                                        <td>$ {{number_format($item->original_price , 2)}}</td>
                                        <td>$ {{number_format($item->offer_price , 2) }}</td>
                                        <td>
                                            <form action="{{route('product.attribute.delete',$item->id)}}"
                                                  method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-sm btn-danger btnRemove"><i
                                                            class="text-white  ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Backend_Files/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/notify/js/notifit-custom.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/js/jquery.multifield.min.js')}}"></script>


    <script>
        $(function () {
            jQuery("[name=select_all]").click(function (source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>

    <script>
        $('#product-attribute').multifield();
    </script>

    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
