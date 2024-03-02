<!DOCTYPE html>
<html lang="en">

@include('WebSite.layouts.head')

<!--- Internal Fontawesome css-->
<link href="{{URL::asset('Backend_Files/asset/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('Backend_Files/asset/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('Backend_Files/asset/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('Backend_Files/asset/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('Backend_Files/asset/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
<body>
<div class="page-wrapper">
    @include('WebSite.layouts.header')
    <main>
        <div class="container">
    <div class="main-error-wrapper ">
        <img style="width: 600px; margin: auto " src="{{URL::asset('Backend_Files/img/media/404.png')}}" class="" alt="error">
        <h3 class="text-center">Oopps. The page you were looking for doesn't exist.</h3>
        <h6 class="text-center">You may have mistyped the address or the page may have moved.</h6>
        <a class="mb-2 d-block m-auto btn btn-outline-danger" href="{{ route('home') }}">Back to Home</a>
    </div>
        </div>
    </main>
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



