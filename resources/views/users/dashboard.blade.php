@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">My Account</h2>
        <div class="row">
            @include('website.useraccount-dashboard')
            <div class="col-lg-9">
                <div class="page-content my-account__dashboard">
                    <div class="mb-2">
                        <h4 class="greeting-message">Hello, <strong>User</strong>!</h4>
                    </div>
                    <p>From your account dashboard you can view your
                        <a class="unerline-link" href="{{route('users.account-orders')}}"><strong> recent
                                orders</strong></a>,
                        manage your
                        <a class="unerline-link" href="{{route('users.account-address')}}"><strong> shipping
                                addresses</strong></a>
                        , and <a class="unerline-link" href="{{route('users.account-details')}}"><strong>edit your
                                password and
                                account details.</strong></a>
                    </p>
                </div>
                <!-- Recent Activity Section -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="recent-activity mb-5">
                            <h4>Recent Activity</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Order #3456 shipped</span>
                                    <span class="badge badge-success">Ordered</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Item added to your Wish List</span>
                                    <span class="badge badge-info">Wish List</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Promotional Section -->
                <div class="promo-section text-center mt-5">
                    <h4>Exclusive Offers for You!</h4>
                    <p>Take advantage of personalized discounts just for you.</p>
                    <a href="/shop" class="btn btn-warning">Shop Now</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection