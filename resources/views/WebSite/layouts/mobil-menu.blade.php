@php use App\Models\Category; @endphp
<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{route('search')}}" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="query" id="mobile-search" placeholder="Search in..."
                   required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <div style="width: 300px !important; position: absolute ; top: 90px;left: 20px; z-index: 1000">
            <select style="color: black;width: 226px;display: none;" id="search_results_dropdown_mobile"></select>
        </div>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('shop')}}">Shop</a>
                </li>

                @php
                    $mobile_categories = Category::where(['status'=> 'active' , 'is_parent' => 1])->orderBy('id', 'desc')->limit('3')->get();
                @endphp
                <li>
                    <a href="" class="sf-with-ul">Category</a>
                    <ul>
                        @if (count($mobile_categories) > 0)
                            @foreach ( $mobile_categories as $category)
                                <li><a href="{{route('product.category', $category->slug)}}">{{$category->title}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{route('aboutus')}}">About</a>
                </li>
                <li>
                    <a href="{{route('contactus')}}">Contact</a>
                </li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div>
