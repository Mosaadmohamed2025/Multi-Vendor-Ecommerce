<!DOCTYPE html>
<html lang="en">
@section('title')
    MyAccount
@stop
@include('WebSite.layouts.head')
<body>
<div class="page-wrapper">
    @include('WebSite.layouts.header')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
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
        <div class="page-header text-center" style="background-image: url('{{asset('WebSite/assets/images/page-header-bg.jpg')}}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="false">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Downloads</a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="true">Adresses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.logout')}}">Sign Out</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                    <p>Hello <span class="font-weight-normal text-dark">{{$user->full_name}}</span>
                                        <br>
                                        From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                    @if(count($orders) > 0)

                                            <div class="table-responsive">
                                                <table id="example" class="table key-buttons text-md-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>Order_Number</th>
                                                        <th>Method</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $order)
                                                    <tr>
                                                        <td style="width: 190px">{{$order->order_number}}</td>
                                                        <td style="width: 190px">{{$order->payment_method =='cod' ? "On Delivery" : $order->payment_method}}</td>
                                                        <td style="width: 190px">
                                                            <span
                                                                   class="@if($order->payment_status == 'paid')
                                                             badge-success
                                                             @else
                                                             badge-danger
                                                            @endif
                                                            py-2 px-2
                                                            "
                                                             style="border-radius: 20%" >{{$order->payment_status}}</span>
                                                        </td>
                                                        <td style="width: 190px">{{$order->currency}} {{$order->total_amount}}</td>
                                                        <td style="width: 190px">{{\Carbon\Carbon::parse($order->created_at)->format('M d y')}}</td>
                                                        <td style="width: 190px">
                                                           <span style="border-radius: 20%" class="badge--}}
                                                                 @if($order->condition == 'pending')
                                                                                            badge-info
                                                                                            @elseif($order->condition == 'processing')
                                                                                            badge-primary
                                                                                            @elseif($order->condition == 'delivered')
                                                                                            badge-success
                                                                                            @else
                                                                                            badge-danger
                                                                                            @endif
                                                                                            py-2 px-2
                                                                 ">{{$order->condition}}
                                                           </span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                    @else
                                    <p>No order has been made yet.</p>
                                    <a href="{{route('shop')}}" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                                    @endif
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                    <p>No downloads available yet.</p>
                                    <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade active show" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                    <p>The following addresses will be used on the checkout page by default.</p>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                                    <p>{{$user->address}}<br>
                                                        {{$user->state}}, {{$user->city}}<br>
                                                        {{$user->country}}<br>
                                                        {{$user->postcode}}<br>
                                                        <a href="#billing-modal" data-toggle="modal">Edit <i class="icon-edit"></i></a></p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->

                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                                    <p>{{$user->saddress}}<br>
                                                        {{$user->sstate}}, {{$user->scity}}<br>
                                                        {{$user->scountry}}<br>
                                                        {{$user->spostcode}}<br>                                                        <a href="#shipping-modal" data-toggle="modal">Edit <i class="icon-edit"></i></a></p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                    <form action="{{route('update.account' , 'test')}}" method="POST"
                                        enctype="multipart/form-data">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        @if (auth()->user()->photo)
                                            <div class="d-flex mb-3 justify-content-center align-items-center">
                                                <a href="#" class="relative"><img style="width: 150px; border-radius: 50%;border:1px solid #cd9966" src="/user_images/{{auth()->user()->photo}}" /></a>
                                            </div>
                                        @else
                                            <div class="d-flex mb-3 justify-content-center align-items-center">
                                                <a href="#" class="relative"><img style="width: 150px; border-radius: 50%" src="{{ asset('WebSite/assets/images/testimonials/user-1.jpg') }}" /></a>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <input class="form-control" value="{{$user->id}}" name="id" type="hidden"/>
                                            <div class="col-sm-6">
                                                <label>Full Name *</label>
                                                <input type="text" class="form-control" required name="full_name" value="{{$user->full_name}}" />
                                            </div><!-- End .col-sm-6 -->
                                            @error('full_name')
                                            <p class="text-white">{{$message}}</p>
                                            @enderror
                                            <div class="col-sm-6">
                                                <label>Display Name *</label>
                                                <input type="text" class="form-control" required name="username" value="{{$user->username}}" />
                                            </div><!-- End .col-sm-6 -->
                                            @error('username')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div><!-- End .row -->


                                        <label>Phone Number </label>
                                        <input type="text" class="form-control" name="phone" value="{{$user->phone}}"  />
                                        @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" readonly name="email" value="{{$user->email}}"  />
                                        @error('email')
                                        <p class="text-danger"></p>
                                        @enderror
                                        <label>Current password </label>
                                        <input type="password" class="form-control" name="oldpassword">
                                        @error('oldpassword')
                                        <p class="text-danger" >{{$message}}</p>
                                        @enderror
                                        <label> New password</label>
                                        <input type="password" class="form-control mb-2"  name="newpassword">
                                        @error('newpassword')
                                        <p class="text-danger" >{{$message}}</p>
                                        @enderror
                                        <label>Upload Photo</label>
                                        <input style="padding: 6px;" class="form-control" type="file" accept="image/*" name="image" onchange="loadFiles(event)">
                                        <div style="margin: 15px" id="output"></div>
                                        @error('image')
                                        <p class="text-danger" >{{$message}}</p>
                                        @enderror
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main>    <!-- End .main -->

    <div class="modal fade" id="billing-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Billing Address</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="{{route('billing.address' , $user->id)}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" value="{{$user->address}}" name="address">
                                        </div><!-- End .form-group -->
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}" >
                                        </div><!-- End .form-group -->
                                        @error('country')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="postcode">Postcode</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{$user->postcode}}">
                                        </div><!-- End .form-group -->
                                        @error('postcode')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state" value="{{$user->state}}">
                                        </div><!-- End .form-group -->
                                        @error('state')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{$user->city}}">
                                        </div><!-- End .form-group -->
                                        @error('city')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Save Changes</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div><!-- End .form-footer -->
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <div class="modal fade" id="shipping-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Shipiing Address</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="{{route('shipping.address' , $user->id)}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="saddress">SAddress</label>
                                            <input type="text" class="form-control" id="saddress" value="{{$user->saddress}}" name="saddress">
                                        </div><!-- End .form-group -->
                                        @error('saddress')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="scountry">SCountry</label>
                                            <input type="text" class="form-control" id="scountry" name="scountry" value="{{$user->scountry}}" >
                                        </div><!-- End .form-group -->
                                        @error('scountry')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="spostcode">SPostcode</label>
                                            <input type="text" class="form-control" id="spostcode" name="spostcode" value="{{$user->spostcode}}">
                                        </div><!-- End .form-group -->
                                        @error('spostcode')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="sstate">SState</label>
                                            <input type="text" class="form-control" id="sstate" name="sstate" value="{{$user->sstate}}">
                                        </div><!-- End .form-group -->
                                        @error('sstate')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="scity">SCity</label>
                                            <input type="text" class="form-control" id="scity" name="scity" value="{{$user->scity}}">
                                        </div><!-- End .form-group -->
                                        @error('scity')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Save Changes</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div><!-- End .form-footer -->
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->


    @include('WebSite.layouts.footer')

</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
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
            img.style.border= '1px solid #cd9966';

            var reader = new FileReader();
            reader.onload = function (e) {
                var imgElement = document.createElement('img');
                imgElement.style.borderRadius = '50%';
                imgElement.style.width = '150px';
                imgElement.style.height = '150px';
                imgElement.style.border= '1px solid #cd9966';
                imgElement.src = e.target.result;

                output.appendChild(imgElement);
            };

            reader.readAsDataURL(files[i]);
        }
    };
</script>
@include('WebSite.layouts.mobil-menu')

@include('WebSite.layouts.add_delete_cart')

@include('WebSite.layouts.auto_search')

@include('WebSite.layouts.footer-scripts')
</body>


</html>



