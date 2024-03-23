@extends('Backend.layouts.master')
@section('title')
    Show Order
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Orders</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
               Show Order</span>
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

    <!-- row -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                  <h2>Order</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $order->first_name }} {{$order->last_name}}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{$order->payment_method =='cod' ? "Cash On Delivery" : $order->payment_method}}</td>
                                <td>{{ucfirst($order->payment_status)}}</td>
                                <td>{{number_format($order->total_amount , 2)}}</td>
                                <td>
                                   <span class="badge--}}
                                         @if($order->condition == 'pending')
                                                                    badge-info
                                                                    @elseif($order->condition == 'processing')
                                                                    badge-primary
                                                                    @elseif($order->condition == 'delivered')
                                                                    badge-success
                                                                    @else
                                                                    badge-danger
                                                                    @endif
                                         ">{{$order->condition}}
                                   </span>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                                                    type="button">Process<i class="fas fa-caret-down mr-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$order->id}}"><i class="text-danger  ti-trash"></i>&nbsp;&nbsp;Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                                @include('Backend.order.delete_select')
                               @include('Backend.order.delete')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <h2>Order Details</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Images</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>@foreach ($item->images as $key => $image)
                                        <img  src="/product_images/{{$image->image}}" style="border-radius: 50%" width="60px" height="60px"  />
                                    @endforeach
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{$item->pivot->quantity}}</td>
                                <td>{{number_format($item->price , 2)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row m-3">
                        <div class="col-6">

                        </div>
                        <div class="col-12 col-sm-6 border py-3">
                            <p>
                                <strong>Subtotal</strong>: ${{number_format($order->sub_total , 2)}}
                            </p>
                            @if($order->delivery_charge)
                                <p>
                                    <strong>Shipping Cost</strong>: ${{number_format($order->delivery_charge , 2)}}
                                </p>
                            @endif
                            @if($order->coupon > 0)
                                <p>
                                    <strong>Coupon</strong>: ${{number_format($order->coupon , 2)}}
                                </p>
                            @endif
                            <p>
                                <strong>Total</strong>: ${{number_format($order->total_amount , 2)}}
                            </p>

                            <form action="{{route('order.status' , $order->id)}}" method="POST">
                                @csrf
                                <strong>Status</strong>
                                <select name="condition" class="form-control" id="">
                                    <option value="pending" {{$order->condition == 'cancelled' || $order->condition == 'delivered' ? 'disabled' : ''}} {{$order->condition == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="processing" {{$order->condition == 'cancelled' || $order->condition == 'delivered' ? 'disabled' : ''}}  {{$order->condition == 'processing' ? 'selected' : ''}}>Processing</option>
                                    <option value="delivered" {{$order->condition == 'cancelled' ? 'disabled' : ''}} {{$order->condition == 'delivered' ? 'selected' : ''}}>Delivered</option>
                                    <option value="cancelled" {{$order->condition == 'delivered' ? 'disabled' : ''}} {{$order->condition == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                </select>
                                <button type="submit" class="py-2 px-3 mt-2 btn btn-success btn-sm">Update</button>
                            </form>
                        </div>
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
