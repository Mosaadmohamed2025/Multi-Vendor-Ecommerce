@extends('Backend.layouts.master')
@section('title')
    Dashboard
@stop
@section('css')
    <!-- Maps css -->
    <link href="{{URL::asset('Backend_Files/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                <p class="mg-b-0">Sales monitoring dashboard template.</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">

            <div>
                <label class="tx-13">Visa Payments</label>
                <h5>
                    {{\App\Models\Order::where('payment_method' , 'stripe')->count()}}
                </h5>
            </div>
            <div>
                <label class="tx-13">Cash Payments</label>
                <h5>
                    {{\App\Models\Order::where('payment_method' , 'cod')->count()}}
                </h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Orders requested are in dollars</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    ${{ number_format(\App\Models\Order::where('currency' , 'usd')->sum('total_amount')) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">Number Of Orders : {{ \App\Models\Order::where('currency' , 'usd')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Orders requested are in euro</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    €{{ number_format(\App\Models\Order::where('currency' , 'eur')->sum('total_amount')) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">Number Of Orders : {{ \App\Models\Order::where('currency' , 'eur')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Orders requested are in egp</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    E£{{ number_format(\App\Models\Order::where('currency' , 'egp')->sum('total_amount')) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">Number Of Orders : {{ \App\Models\Order::where('currency' , 'egp')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Sellers & Customers</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                   All Users :  {{ number_format(\App\Models\User::count()) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7"> Sellers : {{ number_format(\App\Models\User::where('role' , 'vendor')->count())}} & Customers : {{ number_format(\App\Models\User::where('role' , 'customer')->count())}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Order status</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to
                        arrival. To begin, enter your order number.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>{{\App\Models\Order::where('condition' , 'delivered')->count()}}</h4>
                            <label><span style="background-color: #81b214"></span>Delivered</label>
                        </div>
                        <div>
                            <h4>{{\App\Models\Order::where('condition' , 'pending')->count()}}</h4>
                            <label><span style="background-color: #f0ad4e"></span>Pending</label>
                        </div>
                        <div>
                            <h4>{{\App\Models\Order::where('condition' , 'processing')->count()}}</h4>
                            <label><span style="background-color: #0275d8"></span>Processing</label>
                        </div>
                        <div>
                            <h4>{{\App\Models\Order::where('condition' , 'cancelled')->count()}}</h4>
                            <label><span style="background-color: #ec5858"></span>Cancelled</label>
                        </div>
                    </div>
                    <div id="bar" class="sales-bar " style="margin-top: 5rem;">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">Sales Revenue by Customers in USA</label>
                <span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>{{\App\Models\Order::where('payment_status' , 'paid')->count()}}</h4>
                            <label><span style="background-color: #81b214"></span>Paid</label>
                        </div>
                        <div>
                            <h4>{{\App\Models\Order::where('payment_status' , 'unpaid')->count()}}</h4>
                            <label><span style="background-color: #ec5858"></span>Unpaid</label>
                        </div>
                    </div>
                    <div style="margin-top: 5rem;">
                        <div class="vmap-wrapper  ht-180" id="vmap2">
                            {!! $chartjs_2->render() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-1">
                    @php
                        $latestUsers = \App\Models\User::where(['status' => 'active' , 'role' => 'customer'])->latest()->take(6)->get();
                    @endphp
                    <h3 class="card-title mb-2">Recent Customers</h3>
                    <p class="tx-12 mb-0 text-muted">A customer is an individual or business that purchases the goods
                        service has evolved to include real-time</p>
                </div>
                <div class="card-body p-0 customers mt-1">
                    <div class="list-group list-lg-group list-group-flush">
                        @if(count($latestUsers) > 0)
                            @foreach($latestUsers as $user)
                                <div class="list-group-item list-group-item-action" href="#">
                                    <div class="media mt-0">
                                        <img class="avatar-lg rounded-circle mr-3 my-auto"
                                             src="/user_images/{{ $user->photo }}" alt="Image description">
                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <h5 class="mb-1 tx-15">{{$user->full_name}}</h5>
                                                    <p class="mb-0 tx-13 text-muted">User ID: {{$user->id}}
                                                </div>
                                                <span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark1" class="wd-100p"></div>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    @php
                        $latestOrders = \App\Models\Order::latest()->take(6)->get();
                    @endphp
                    <h4 class="card-title mb-1">Your Most Recent Orders</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3 ">This is your most recent orders .</span>
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th> Method</th>
                            <th>Total</th>
                            <th>Currency</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestOrders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->first_name }} {{$order->last_name}}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{$order->payment_method =='cod' ? "Cash On Delivery" : $order->payment_method}}</td>
                                <td>{{number_format($order->total_amount , 2)}}</td>
                                <td>{{$order->currency}}</td>
                                <td>{{ucfirst($order->payment_status)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row close -->

    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('Backend_Files/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('Backend_Files/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('Backend_Files/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('Backend_Files/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('Backend_Files/js/index.js')}}"></script>
    <script src="{{URL::asset('Backend_Files/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
