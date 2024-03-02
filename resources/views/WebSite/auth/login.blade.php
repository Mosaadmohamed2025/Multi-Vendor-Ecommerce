<!DOCTYPE html>
<html lang="en">
@section('title')
    Login
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
    <main class="main" style="background-image: url('/WebSite/assets/images/backgrounds/login-bg.jpg')">
        <nav style="background-color: white" aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/user/auth">Login/Signin</a></li>
                </ol>
            </div><!-- End .container -->
        </nav>
        <div class="form-box" style="margin-bottom: 25px;">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content-5">
                    <div class="tab-pane fade active show" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                        <form action="{{route('login.submit')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email">Username or email address *</label>
                                <input type="text" class="form-control" id="singin-email" name="email" required="">
                            </div><!-- End .form-group -->
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <div class="form-group">
                                <label for="singin-password">Password *</label>
                                <input type="password" class="form-control" id="singin-password" name="password" required="">
                            </div><!-- End .form-group -->
                            @error('password')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <a href="#" class="forgot-link">Forgot Your Password?</a>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form action="{{route('register.submit')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="register-full-name">Ful Name *</label>
                                <input type="text" class="form-control" id="register-full-name" name="full_name" required>
                            </div><!-- End .form-group -->
                            @error('full_name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="register-username">User Name *</label>
                                <input type="text" class="form-control" id="register-username" name="username" required>
                            </div><!-- End .form-group -->
                            @error('username')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="register-email">Your email address *</label>
                                <input type="email" class="form-control" id="register-email" name="email" required>
                            </div><!-- End .form-group -->
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="register-password">Password *</label>
                                <input type="password" class="form-control" id="register-password" name="password" required="">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="register-password">Confirm Password *</label>
                                <input type="password" class="form-control" id="register-password" name="password_confirmation" required="">
                            </div><!-- End .form-group -->
                            @error('password')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div>
    </main>
    <!-- End .main -->

    @include('WebSite.layouts.footer')

</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

@include('WebSite.layouts.mobil-menu')


@include('WebSite.layouts.add_delete_wishlist')

@include('WebSite.layouts.add_delete_cart')

@include('WebSite.layouts.auto_search')


@include('WebSite.layouts.footer-scripts')
</body>


</html>



