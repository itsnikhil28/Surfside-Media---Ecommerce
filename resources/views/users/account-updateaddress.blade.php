@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Address</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="my-account.html" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="account-orders.html" class="menu-link menu-link_us-s">Orders</a></li>
                    <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>
                    <li><a href="login.html" class="menu-link menu-link_us-s">Logout</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__address">
                    <div class="row">
                        <div class="col-6">
                            <p class="notice">The following addresses will be used on the checkout page by default.</p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('users.account-address')}}" class="btn btn-sm btn-danger">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="mt-3">Update Address</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('users.account-address-update')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="name" value="{{$address->name}}">
                                                    <label for="name">Full Name *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="phone" value="{{$address->phone}}">
                                                    <label for="phone">Phone Number *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="zip" value="{{$address->zip}}">
                                                    <label for="zip">Pincode *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mt-3 mb-3">
                                                    <input type="text" class="form-control" name="state" value="{{$address->state}}">
                                                    <label for="state">State *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="city" value="{{$address->city}}">
                                                    <label for="city">Town / City *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="address" value="{{$address->address}}">
                                                    <label for="address">House no, Building Name *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="locality" value="{{$address->locality}}">
                                                    <label for="locality">Road Name, Area, Colony *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" name="landmark" value="{{$address->landmark}}">
                                                    <label for="landmark">Landmark *</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="isdefault" name="isdefault">
                                                    <label class="form-check-label" for="isdefault">
                                                        Make as Default address
                                                    </label>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection