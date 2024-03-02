@if(count(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content()) > 0)
@foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
    <tr>
    <td class="product-col">
        <div class="product">
            <figure class="product-media">
                <a href="#">
                    <img src="/product_images/{{$item->model->images[0]->image}}" alt="Product image">
                </a>
            </figure>

            <h3 class="product-title">
                <a href="#">{{$item->name}}</a>
            </h3><!-- End .product-title -->
        </div><!-- End .product -->
    </td>
    <td class="price-col">{{Helper::currency_converter($item->price)}}</td>
    <td class="action-col">
        <button data-id="{{$item->rowId}}" class="btn btn-block btn-outline-primary-2 wishlist_move_to_cart"><i class="icon-cart-plus"></i>Add to Cart</button>
    </td>
    <td class="remove-col">
        <a href="#" data-id="{{$item->rowId}}" class="btn-remove wishlist_delete" title="Remove Product"><i class="icon-close"></i></a>
    </td>
</tr>
@endforeach
    @else
    <td class="text-danger">No Product Found In Your Wishlist</td>
@endif
