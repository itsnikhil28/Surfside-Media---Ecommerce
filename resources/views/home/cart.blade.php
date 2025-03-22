@extends('layouts.app')
@section('content')
<style>
    .text-danger {
        color: red !important;
    }

    .text-success {
        color: green !important;
    }
</style>
{{-- @dd(Session::all()) --}}
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>
        <div class="checkout-steps">
            <a href="/cart" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            {{-- <a href="{{!(session('id')) ? '/login' : '/cart/checkout'}}" class="checkout-steps__item"> --}}
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="{{!(session('id')) ? '/login' : '/cart/order-confirmation'}}" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
        </div>
        @if ($cartitems->count() > 0)
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartitems as $item)
                        <tr>
                            {{-- @dd($item->options['image']) --}}
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{asset('storage/products/'.$item->options['image'])}}"
                                        width="120" height="120" alt="" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{$item->name}}</h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <li>Color: Yellow</li>
                                        <li>Size: L</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">&#8377;{{$item->price}}</span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{$item->qty}}" min="1"
                                        class="qty-control__number text-center">
                                    <form action="{{route('cart.itemdecrease')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->rowId}}">
                                        <div class="qty-control__reduce">-</div>
                                    </form>
                                    <form action="{{route('cart.itemincrease')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->rowId}}">
                                        <div class="qty-control__increase">+</div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">&#8377;{{$item->subtotal()}}</span>
                            </td>
                            <td>
                                <form action="{{route('cart.itemremove')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->rowId}}">
                                    <a href="javascript:void(0)" class="remove-cart">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                            <path
                                                d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                        </svg>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-table-footer">
                    @if(session()->has('coupon'))
                    <form class="position-relative bg-body" action="{{route('coupon.remove')}}" method="POST">
                        @csrf
                        <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code"
                            value="{{session()->get('coupon')['code'] }} applied!">
                        <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                            value="REMOVE COUPON">
                    </form>
                    @else
                    <form class="position-relative bg-body" action="{{route('coupon.apply')}}" method="POST">
                        @csrf
                        <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                        <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                            value="APPLY COUPON">
                    </form>
                    @endif
                    <form action="{{route('cart.cartempty')}}" method="post">
                        @csrf
                        <button class="btn btn-light" type="submit">CLEAR CART</button>
                    </form>
                </div>
                <div>
                    @if(session('success'))
                    <span class="alert text-success p-2 mt-2">{{session('success')}}</span>
                    @elseif(session('error'))
                    <span class="alert text-danger p-2 mt-2">{{session('error')}}</span>
                    @endif
                </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                                @if (Session::has('discounts'))
                                <tr>
                                    <th>Subtotal</th>
                                    <td>&#8377;{{Cart::instance('cart')->subtotal()}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>&#8377;{{Session::get('discounts')['discount']}}</td>
                                </tr>
                                <tr>
                                    <th>Subtotal After Discount</th>
                                    <td>&#8377;{{Session::get('discounts')['subtotal']}}</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>FREE</td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>&#8377;{{Session::get('discounts')['tax']}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>&#8377;{{Session::get('discounts')['total']}}</td>
                                </tr>
                                @else
                                <tr>
                                    <th>Subtotal</th>
                                    <td>&#8377;{{Cart::instance('cart')->subtotal()}}</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>
                                        <div>
                                            FREE
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="free_shipping">
                                            <label class="form-check-label" for="free_shipping">Free shipping</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="flat_rate">
                                            <label class="form-check-label" for="flat_rate">Flat rate: &#8377;49</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="local_pickup">
                                            <label class="form-check-label" for="local_pickup">Local pickup: &#8377;8</label>
                                        </div>
                                        <div>Shipping to AL.</div>
                                        <div>
                                            <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                        </div> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>&#8377;{{Cart::instance('cart')->tax()}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>&#8377;{{Cart::instance('cart')->total()}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="{{!(session('id')) ? '/login' : '/cart/checkout'}}"
                                class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="mt-4 col-md-12 text-center">
                <h6>No item found in your cart</h6>
                <a href="{{route('shop.index')}}" class="btn btn-info">SHOP NOW</a>
            </div>
        </div>
        @endif
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.qty-control__increase').forEach(function(element) {
            element.addEventListener('click', function() {
                this.closest('form').submit();
            });
        });
    
        document.querySelectorAll('.qty-control__reduce').forEach(function(element) {
            element.addEventListener('click', function() {
                this.closest('form').submit();
            });
        });

        document.querySelectorAll('.remove-cart').forEach(function(element) {
            element.addEventListener('click', function() {
                this.closest('form').submit();
            });
        });
       
    });
</script>
@endsection