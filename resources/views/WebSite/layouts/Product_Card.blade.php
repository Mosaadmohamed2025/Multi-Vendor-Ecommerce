<div class="col-6 col-md-4 col-xl-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <span class="product-label label-sale">{{$item->conditions}}</span>
            <a href="{{route('product.detail',$item->slug)}}">
                <img src="/product_images/{{ $item->images[0]->image }}" alt="Product image" style="height: 300px;width: 100%;" class="product-image">
                <img src="/product_images/{{ $item->images[1]->image }}" alt="Product image" class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" data-quantity="1" data-id="{{$item->id}}"
                   id="add_to_wishlist_{{$item->id}}"
                   class="add_to_wishlist btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" data-quantity="1"
                   data-product-id="{{$item->id}}"
                   id="add-to-cart{{$item->id}}"
                   class="add_to_cart  btn-product btn-cart"><span>add to cart</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat">
                <a href="#">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a
                    href="{{route('product.detail',$item->slug)}}">{{$item->title}}</a>
            </h3><!-- End .product-title -->
            <div class="product-price">
                <span class="new-price"><del>{{Helper::currency_converter($item->price)}}</del></span>
                <span class="old-price">{{Helper::currency_converter($item->offer_price)}}</span>
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-xl-3 -->
