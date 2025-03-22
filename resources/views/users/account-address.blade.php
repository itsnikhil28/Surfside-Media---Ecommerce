@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Addresses</h2>
        <div class="row">
            @include('website.useraccount-dashboard')
            <div class="col-lg-10">
                <div class="page-content my-account__address">
                    <div class="row">
                        <div class="col-6">
                            <p class="notice">The following addresses will be used on the checkout page by default.</p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('users.account-address-add')}}" class="btn btn-sm btn-info">Add New</a>
                        </div>
                    </div>
                    <div class="my-account__address-list row">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__title">
                                <h5>{{$address->name}} <i class="fa fa-check-circle text-success"></i></h5>
                                <a href="{{route('users.account-address-edit')}}">Edit</a>
                            </div>
                            <div class="my-account__address-item__detail">
                                <p>{{$address->address}}</p>
                                <p>{{$address->landmark}} , {{$address->locality}}</p>
                                <p>{{$address->city}}, </p>
                                <p>{{$address->zip}} , {{$address->state}}</p>
                                <p>{{$address->country}}</p>
                                <br>
                                <p>Mobile : {{$address->phone}}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection