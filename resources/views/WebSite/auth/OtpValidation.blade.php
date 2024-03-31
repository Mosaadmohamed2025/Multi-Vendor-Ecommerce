<!DOCTYPE html>
<html lang="en">
@section('title')
    OTP
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

        <div class="form-box" style="margin-top: 25px ; margin-bottom: 25px">
             <form class="submitotp" action="{{route('email.verification')}}" method="post">
                 @csrf
                 <label >Enter The Email</label>
                 <input type="email" name="email" class="form-control"/>
                 @error('email')
                 <div class="text-danger">{{$message}}</div>
                 @enderror

                 <label >Enter The OTP Code</label>
                 <input type="text" name="code"  class="form-control"/>
                 @error('code')
                 <div class="text-danger">{{$message}}</div>
                 @enderror
                 <button type="submit" class="btn mt-2 btn-outline-primary-2">
                     <span>Submit</span>
                     <i class="icon-long-arrow-right"></i>
                 </button>
                 <p class="resend mt-2" style="cursor: pointer">I need to resend OTP code</p>
             </form>
            <form class="resendotp d-none" action="{{route('resend.otp')}}" method="post">
                @csrf
                <label >Enter The Email</label>
                <input type="email" name="email" class="form-control"/>
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <button type="submit" class="btn mt-2 btn-outline-primary-2">
                    <span>Send</span>
                    <i class="icon-long-arrow-right"></i>
                </button>

                <p  style="cursor: pointer" class="back mt-2">
                    <i class="icon-long-arrow-left"></i>
                    Back
                </p>
            </form>
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

<script>
    document.querySelector('.resend').onclick = ()=>{
        document.querySelector('.submitotp').classList.add('d-none');
        document.querySelector('.resendotp').classList.remove('d-none');
    }

    document.querySelector('.back').onclick = () =>{
        document.querySelector('.resendotp').classList.add('d-none');
        document.querySelector('.submitotp').classList.remove('d-none');
    }
</script>
</body>


</html>



