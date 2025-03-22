@extends('layouts.admin')
@section('content')
<div class="main-content">
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Order Details</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{route('admin.orders')}}">
                            <div class="text-tiny">Orders</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order Items</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Ordered Items</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 150px">Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">SKU</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Brand</th>
                                {{-- <th class="text-center">Options</th> --}}
                                <th class="text-center">Return Status</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="pname">
                                    <div class="image">
                                        <img src="{{asset('storage/products/'.$item->product->image)}}" alt=""
                                            class="image">
                                    </div>
                                    <div class="name">
                                        <a href="{{route('product.detail',$item->product->slug)}}" target="_blank"
                                            class="body-title-2">{{$item->product->name}}</a>
                                    </div>
                                </td>
                                <td class="text-center">&#8377;{{$item->price}}</td>
                                <td class="text-center">{{$item->quantity}}</td>
                                <td class="text-center">{{$item->product->SKU}}</td>
                                <td class="text-center">{{$item->product->category->name}}</td>
                                <td class="text-center">{{$item->product->brand->name}}</td>
                                {{-- <td class="text-center"></td> --}}
                                <td class="text-center">{{$item->rstatus==false?"NO":"YES"}}</td>
                                {{-- <td class="text-center">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>Shipping Address</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>{{$order->name}}</p>
                        <p>{{$order->address}}</p>
                        <p>{{$order->landmark}} , {{$order->locality}}</p>
                        <p>{{$order->city}}, </p>
                        <p>{{$order->zip}} , {{$order->state}}</p>
                        <p>{{$order->country}}</p>
                        <br>
                        <p>Mobile : {{$order->phone}}</p>
                    </div>
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>Transaction</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>&#8377;{{$order->subtotal}}</td>
                                <th>Tax</th>
                                <td>&#8377;{{$order->tax}}</td>
                                <th>Discount</th>
                                <td>&#8377;{{$order->discount}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>&#8377;{{$order->total}}</td>
                                <th>Payment Mode</th>
                                <td>{{strtoupper($order->transaction->mode)}}</td>
                                <th>Status</th>
                                <td>{{$order->transaction->status}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Delivered Date</th>
                                <td>{{$order->delivered_date->format('d M Y')}}</td>
                                <th>Canceled Date</th>
                                <td>{{$order->canceled_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @php
            $transactiondetails = ($order->transaction->transactiondetail->first())
            @endphp
            @if ($transactiondetails)
            <div class="wg-box mt-5">
                <h5>Transaction Detail</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th style="width: 150px">Merchant ID</th>
                                <td style="width: 150px;">
                                    <p style="margin-top:15px">{{$transactiondetails->merchantid}}</p>
                                </td>
                                <th>Merchant Transaction ID</th>
                                <td>{{$transactiondetails->merchanttransactionid}}</td>
                                <th>Payment Transaction ID</th>
                                <td>{{$transactiondetails->paymenttransactionid}}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>&#8377;{{$transactiondetails->amount}}</td>
                                <th>Payment Mode</th>
                                <td>{{strtoupper($order->transaction->mode)}}</td>
                                <th>State</th>
                                <td>{{$transactiondetails->state}}</td>
                            </tr>
                            @php
                            $chunks = array_chunk($transactiondetails->paymentdetails, 3, true);
                            @endphp

                            @foreach($chunks as $chunk)
                            <tr>
                                @foreach($chunk as $key => $value)
                                <th>{{ ucfirst( $key) }}</th>
                                <td>{{ $value ?? 'N/A'}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>

    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
@endsection