@if(count(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content()) > 0)
@foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
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
        <td class="quantity-col">
            <div class="text-center cart-product-quantity">
                <span>{{$item->qty}}</span>
            </div><!-- End .cart-product-quantity -->
        </td>
        <td class="total-col">{{Helper::currency_converter($item->qty * $item->price)}}</td>
        <td class="remove-col">
            <a href="#" data-id="{{$item->rowId}}" class="btn-remove cart_delete" title="Remove Product"><i class="icon-close"></i></a>
        </td>
    </tr>
@endforeach
@else
    <td class="text-danger">No Product Found In Your Cart</td>
@endif
