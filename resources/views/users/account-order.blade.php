@extends('layouts.app')
@section('content')
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            @include('website.useraccount-dashboard')
            <div class="col-lg-10">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">OrderNo</th>
                                    <th>Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{substr($order->id, -6)}}</td>
                                    <td class="text-center">{{$order->name}}</td>
                                    <td class="text-center">{{$order->phone}}</td>
                                    <td class="text-center">&#8377;{{$order->subtotal}}</td>
                                    <td class="text-center">&#8377;{{$order->tax}}</td>
                                    <td class="text-center">&#8377;{{$order->total}}</td>

                                    <td class="text-center">
                                        <span class="badge bg-danger">{{$order->status}}</span>
                                    </td>
                                    <td class="text-center">{{$order->created_at->format('d M Y')}}</td>
                                    <td class="text-center">{{$order->orderItems->count()}}</td>
                                    @if($order->delivered_date < now()) <td>
                                        {{ $order->delivered_date->format('d M Y')}}
                                        </td>
                                        @else
                                        <td>Not Delivered</td>
                                        @endif
                                        <td class="text-center">
                                            <a href="{{route('users.account-order-detail',$order->id)}}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="fa fa-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <h3 class="mb-3 mt-5">No Order Yet ? </h3>
                                        <a href="/shop" class="btn btn-info">Shop Now</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </section>
</main>
@endsection