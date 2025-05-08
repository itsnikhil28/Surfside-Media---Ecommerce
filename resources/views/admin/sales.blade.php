@extends('layouts.admin')
@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Sales Products</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="/admin-dashboard">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Sales Products</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                                    value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="/add-sale"><i class="icon-plus"></i>Add new</a>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Deal Price</th>
                                    <th>Deal Type</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Stock</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1
                                @endphp
                                @foreach ($sales as $sale)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ Storage::disk('s3')->url('products/'.$sale->product->image) }}"
                                                alt="" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="javascript:void(0)"
                                                class="body-title-2">{{$sale->product->name}}</a>
                                            <div class="text-tiny mt-3">{{$sale->product->slug}}</div>
                                        </div>
                                    </td>
                                    <td>&#8377;{{$sale->product->regular_price}}</td>
                                    <td>&#8377;{{$sale->deal_price}}</td>
                                    <td>{{$sale->deal_type}}</td>
                                    <td>{{$sale->product->category->name}}</td>
                                    <td>{{$sale->product->brand->name}}</td>
                                    <td>{{$sale->product->stock_status}}</td>
                                    <td>{{$sale->product->quantity}}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a target="_blank">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </a>
                                            <a href="{{route('admin.sale.edit',$sale->id)}}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{route('admin.sale.delete',$sale->id)}}" method="POST">
                                                @csrf
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                $i++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-center flex-wrap gap10 wgp-pagination">
                        {{ $sales->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
@endsection