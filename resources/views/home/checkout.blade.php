@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Shipping and Checkout</h2>
        <div class="checkout-steps">
            <a href="/cart" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="/cart/checkout" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Shipping and Checkout</span>
                    <em>Checkout Your Items List</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmation</span>
                    <em>Review And Submit Your Order</em>
                </span>
            </a>
        </div>
        <form name="checkout-form" id="checkout-form" action="{{route('cart.place-order')}}" method="POST">
            @csrf
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <h4>SHIPPING DETAILS</h4>
                            <h4><a href="javascript:void(0)"
                                    onclick="document.querySelectorAll('#checkout-form input').forEach(input => input.removeAttribute('readonly'));"><i
                                        class="fa fa-edit"></i>Edit</a></h4>
                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                    @if (!$address)
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" required="">
                                <label for="name">Full Name *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone" required="">
                                <label for="phone">Phone Number *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="zip" required="">
                                <label for="zip">Pincode *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" name="state" required="">
                                <label for="state">State *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="city" required="">
                                <label for="city">Town / City *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="address" required="">
                                <label for="address">House no, Building Name *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="locality" required="">
                                <label for="locality">Road Name, Area, Colony *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="landmark" required="">
                                <label for="landmark">Landmark *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" required=""
                                    value="{{$address->name}}" @if($address->name) {{"readonly"}} @endif>
                                <label for="name">Full Name *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone" required=""
                                    value="{{$address->phone}}" @if($address->phone) {{"readonly"}} @endif>
                                <label for="phone">Phone Number *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="zip" required="" value="{{$address->zip}}"
                                    @if($address->zip) {{"readonly"}} @endif>
                                <label for="zip">Pincode *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" name="state" required=""
                                    value="{{$address->state}}" @if($address->state) {{"readonly"}} @endif>
                                <label for="state">State *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="city" required=""
                                    value="{{$address->city}}" @if($address->city) {{"readonly"}} @endif>
                                <label for="city">Town / City *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="address" required=""
                                    value="{{$address->address}}" @if($address->address) {{"readonly"}} @endif>
                                <label for="address">House no, Building Name *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="locality" required=""
                                    value="{{$address->locality}}" @if($address->name) {{"readonly"}} @endif>
                                <label for="locality">Road Name, Area, Colony *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="landmark" required=""
                                    value="{{$address->landmark}}" @if($address->landmark) {{"readonly"}} @endif>
                                <label for="landmark">Landmark *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>Your Order</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th align="right">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <tr>
                                        <td>
                                            {{$item->name}} x {{$item->qty}}
                                        </td>
                                        <td align="right">
                                            &#8377;{{$item->subtotal()}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    @if (Session::has('discounts'))
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td align="right">&#8377;{{Cart::instance('cart')->subtotal()}}</td>
                                    </tr>
                                    <tr>
                                        <th>DISCOUNT</th>
                                        <td align="right">&#8377;{{Session::get('discounts')['discount']}}</td>
                                    </tr>
                                    <tr>
                                        <th>SUBTOTAL AFTER DISCOUNT</th>
                                        <td align="right">&#8377;{{Session::get('discounts')['subtotal']}}</td>
                                    </tr>
                                    <tr>
                                        <th>SHIPPING</th>
                                        <td align="right">Free Shipping</td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td align="right">&#8377;{{Session::get('discounts')['tax']}}</td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td align="right">&#8377;{{Session::get('discounts')['total']}}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td align="right">&#8377;{{Cart::instance('cart')->subtotal()}}</td>
                                    </tr>
                                    <tr>
                                        <th>SHIPPING</th>
                                        <td align="right">Free shipping</td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td align="right">&#8377;{{Cart::instance('cart')->tax()}}</td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td align="right">&#8377;{{Cart::instance('cart')->total()}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__payment-methods">
                            <div class="mb-3">
                                <h5>Please select <b>PhonePe</b> or <b>Cash on delivery</b>. We are working on other payment methods</h5>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                    id="mode1" value="phonepe">
                                <label class="form-check-label" for="mode1">
                                    PhonePe
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                    id="mode2" value="card">
                                <label class="form-check-label" for="mode2">
                                    Debit or Credit Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                    id="mode3" value="cod">
                                <label class="form-check-label" for="mode3">
                                    Cash on delivery
                                </label>
                            </div>
                            {{-- <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                    id="mode4" value="paypal">
                                <label class="form-check-label" for="mode4">
                                    Paypal
                                </label>
                            </div> --}}
                            <div class="policy-text">
                                Your personal data will be used to process your order, support your experience
                                throughout this website, and for
                                other purposes described in our <a href="/terms" target="_blank">privacy policy</a>.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-checkout"
                            onclick="document.getElementById('checkout-form').submit()">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection