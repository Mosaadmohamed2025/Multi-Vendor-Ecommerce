@extends('Backend.layouts.master')
@section('title')
    Coupons
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Coupon Management</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     All Coupons</span>
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
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    <a href="{{route('Coupons.create')}}" class="btn btn-primary" role="button"
                       aria-pressed="true">Add Coupon</a>
                    <button type="button" class="btn btn-danger" id="btn_delete_all">Delete Selected</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input name="select_all" id="example-select-all" type="checkbox"/></th>
                                <th>Code</th>
                                <th>type</th>
                                <th>value</th>
                                <th>status</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="delete_select" value="{{$coupon->id}}"
                                               class="delete_select">
                                    </td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    <td>{{ $coupon->value }}</td>
                                    <td>
                                        @if ($coupon->status === 'active')
                                            <span class="label text-success d-flex"
                                                  style=" display: flex;align-items: center;justify-content: center; flex-direction: column;">
                                            <div class="dot-label bg-success ml-1"></div>
                                            <span style="margin-right: 30px">{{ $coupon->status }}</span>
                                        </span>
                                        @else
                                            <span class="label text-danger d-flex"
                                                  style=" display: flex;align-items: center;justify-content: center; flex-direction: column;">
                                            <div class="dot-label bg-danger ml-1"></div>
                                            <span style="margin-right: 40px">{{ $coupon->status }}</span>
                                        </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Process<i class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('Coupons.edit',$coupon->id)}}"><i
                                                            style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;Update</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete{{$coupon->id}}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;Delete</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('Backend.coupons.delete_select')
                                @include('Backend.coupons.delete')
                            @endforeach
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
