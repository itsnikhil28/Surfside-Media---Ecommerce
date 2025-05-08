@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Wishlist</h2>
        {{-- <div class="checkout-steps">
            <a href="shop_cart.html" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="shop_checkout.html" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Shipping and Checkout</span>
                    <em>Checkout Your Items List</em>
                </span>
            </a>
            <a href="shop_order_complete.html" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmation</span>
                    <em>Review And Submit Your Order</em>
                </span>
            </a>
        </div> --}}
        @if($wishlists->count() > 0)
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                        {{-- @dd($wishlist->product->name) --}}
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy"
                                        src="{{ Storage::disk('s3')->url('products/'.$wishlist->product->image) }}"
                                        width="120" height="120" alt="" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{$wishlist->product->name}}</h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <li>Color: Yellow</li>
                                        <li>Size: L</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">
                                    @if ($wishlist->product->sale_price)
                                    &#8377;{{$wishlist->product->sale_price}}
                                    @else
                                    &#8377;{{$wishlist->product->regular_price}}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{$wishlist->productqty}}" min="1"
                                        class="qty-control__number text-center">
                                    <form action="{{route('wishlist.itemdecrease')}}" method="post"
                                        id="wishlistdecrease-{{$wishlist->id}}">
                                        @csrf
                                        <input type="hidden" name="wishlistid" value="{{$wishlist->id}}">
                                        <div class="qty-control__reduce"
                                            onclick="document.getElementById('wishlistdecrease-{{$wishlist->id}}').submit();">
                                            -</div>
                                    </form>
                                    <form action="{{route('wishlist.itemincrease')}}" method="post"
                                        id="wishlistincrease-{{$wishlist->id}}">
                                        @csrf
                                        <input type="hidden" name="wishlistid" value="{{$wishlist->id}}">
                                        <div class="qty-control__increase"
                                            onclick="document.getElementById('wishlistincrease-{{$wishlist->id}}').submit();">
                                            +</div>
                                    </form>
                                </div><!-- .qty-control -->
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">
                                    @if ($wishlist->product->sale_price)
                                    &#8377;{{$wishlist->product->sale_price * $wishlist->productqty}}
                                    @else
                                    &#8377;{{$wishlist->product->regular_price * $wishlist->productqty}}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <form action="{{route('wishlist.remove')}}" method="post"
                                            id="wishlistremove-{{$wishlist->id}}">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{$wishlist->product->id}}">
                                            <a href="javascript:void(0)" class="remove-cart"
                                                onclick="document.getElementById('wishlistremove-{{$wishlist->id}}').submit()">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                    <path
                                                        d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        @if(Cart::instance('cart')->content()->where('id',$wishlist->product->id)->count()>0)
                                        <a href="/cart" class="btn btn-danger">GO TO CART</a>
                                        @else
                                        <form name="addtocart-form" method="POST" action="{{route('cart.add')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$wishlist->product->id}}">
                                            <input type="hidden" name="quantity" value="1" min="1"
                                                class="qty-control__number text-center">
                                            <input type="hidden" name="from_wishlist_page" value="1">
                                            <button type="submit" class="btn btn-primary btn-addtocart"
                                                data-aside="cartDrawer">Add to
                                                Cart</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-table-footer">
                    {{-- <form action="#" class="position-relative bg-body">
                        <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                        <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                            value="APPLY COUPON">
                    </form> --}}
                    <form action="{{route('wishlist.empty')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-light">CLEAR WISHLIST</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="mt-4 col-md-12 text-center">
                <h6>No item found in your wishlist</h6>
                <a href="/shop" class="btn btn-info">ADD NOW</a>
            </div>
        </div>
        @endif
        {{-- <div class="shopping-cart__totals-wrapper">
            <div class="sticky-content">
                <div class="shopping-cart__totals">
                    <h3>Cart Totals</h3>
                    <table class="cart-totals">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>$1300</td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                            id="free_shipping">
                                        <label class="form-check-label" for="free_shipping">Free shipping</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                            id="flat_rate">
                                        <label class="form-check-label" for="flat_rate">Flat rate: &#8377;49</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                            id="local_pickup">
                                        <label class="form-check-label" for="local_pickup">Local pickup:
                                            &#8377;8</label>
                                    </div>
                                    <div>Shipping to AL.</div>
                                    <div>
                                        <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT</th>
                                <td>&#8377;19</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>&#8377;1319</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mobile_fixed-btn_wrapper">
                    <div class="button-wrapper container">
                        <button class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
</main>
@endsection