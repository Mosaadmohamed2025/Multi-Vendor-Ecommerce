@if(count(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content()) > 0)
    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
        <tr>
            <td class="product-col">
                <div class="product">
                    <figure class="product-media">
                        <a href="#">
                            <img src="/product_images/{{$item->model->images[0]->image}}" alt="Product image">
                        </a>
                    </figure>

                </div><!-- End .product -->
            </td>
            <td >
                <h3 class="product-title">
                    <a href="#">{{$item->name}}</a>
                </h3><!-- End .product-title -->
            </td>
            <td style="width: 180px">
                <div class="rating">
                    @for($i =0 ; $i < 5 ; $i++)
                        @if(round($item->model->reviews->avg('rate'))>$i)
                            <i class="fa-star star fas"></i>
                        @else
                            <i class="far fa-star star"></i>
                        @endif
                    @endfor
                </div>
            </td>
            <td  class="price-col">{{Helper::currency_converter($item->price)}}</td>
            <td>{{ substr($item->model->summary, 0, 50) }}....</td>
            <td>{{$item->model->brand['title']}}</td>
            @if($item->model->stock > 0)
            <td>In Stock</td>
            @else
                <td style="width: 140px">Out Of Stock</td>
            @endif
            <td>{{$item->model->size}}</td>
            <td class="action-col">
                <button data-id="{{$item->rowId}}" class="btn btn-block btn-outline-primary-2 compare_move_to_cart"><i class="icon-cart-plus"></i>Add to Cart</button>
            </td>
            <td class="remove-col">
                <a href="#" data-id="{{$item->rowId}}" class="btn-remove compare_delete" title="Remove Product"><i class="icon-close"></i></a>
            </td>
        </tr>
    @endforeach
@else
    <td class="text-danger">No Product Found </td>
@endif
