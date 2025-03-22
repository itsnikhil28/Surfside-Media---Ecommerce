@extends('layouts.admin')
@section('content')
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Product</h3>
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
                        <a href="all-product.html">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <div id="product-details-div">
                <form class="tf-section-2 form-add-product mt-5" method="POST" action="{{route('admin.sale.update')}}">
                    @csrf
                    <div class="wg-box">
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <input type="hidden" name="id" id="id" value="{{$sale->id}}">
                        <fieldset class="name">
                            <div class="body-title mb-10">Product name</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                                value="{{$sale->product->name}}" aria-required="true" readonly disabled id="product_name">
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Slug<div>
                                    <input class="mb-10" type="text" placeholder="Enter product slug" name="slug"
                                        tabindex="0" value="{{$sale->product->slug}}" aria-required="true" readonly disabled id="product_slug">
                        </fieldset>

                        <div class="gap22 cols">
                            <fieldset class="category">
                                <div class="body-title mb-10">Category</span>
                                </div>
                                <input class="mb-10" type="text" placeholder="Category name" name="name" tabindex="0"
                                    value="{{$sale->product->category->name}}" aria-required="true" readonly disabled id="product_category">
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Brand</span>
                                </div>
                                <input class="mb-10" type="text" placeholder="Brand name" name="name" tabindex="0"
                                    value="{{$sale->product->brand->name}}" aria-required="true" readonly disabled id="product_brand">
                            </fieldset>
                        </div>

                        <div class="cols gap22">
                            <fieldset class="name">
                                <div class="body-title mb-10">Regular Price</span></div>
                                <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                                    tabindex="0" value="{{$sale->product->regular_price}}" aria-required="true" readonly id="product_regular_price">
                            </fieldset>
                        </div>

                        <div class="cols gap22">
                            <fieldset class="name">
                                <div class="body-title mb-10">Deal Price <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="text" placeholder="Enter Deal price" name="deal_price"
                                    tabindex="0" value="{{$sale->deal_price}}" aria-required="true" required="">
                            </fieldset>
                        </div>
                    </div>
                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title">Image</span>
                            </div>
                            <div class="upload-image flex-grow">
                                <div class="item" id="imgpreview" style="display:block">
                                    <img src="{{asset('storage/products/'.$sale->product->image)}}" class="effect8" alt="" id="product_image">
                                </div>
                            </div>
                        </fieldset>

                        <div class="cols gap22">
                            <fieldset class="name">
                                <div class="body-title mb-10">SKU</span>
                                </div>
                                <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0"
                                    value="{{$sale->product->SKU}}" aria-required="true" readonly disabled id="product_sku">
                            </fieldset>
                            <fieldset class="name">
                                <div class="body-title mb-10">Quantity</span>
                                </div>
                                <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                                    tabindex="0" value="{{$sale->product->quantity}}" aria-required="true" readonly disabled id="product_quantity">
                            </fieldset>
                        </div>

                        <div class="cols gap22">
                            <fieldset class="name">
                                <div class="body-title mb-10">Stock</div>
                                <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                                    tabindex="0" value="{{$sale->product->stock_status}}" aria-required="true" readonly disabled id="product_stock">
                            </fieldset>
                        </div>
                        <div class="cols gap22">
                            <fieldset class="name">
                                <div class="body-title mb-10">Deal Type <span class="tf-color-1">*</span></div>
                                <div class="select mb-10">
                                    <select class="" name="dealtype">
                                        <option value="" disabled>Select Deal Type</option>
                                        <option value="summer" {{$sale->deal_type == 'summer' ? 'selected' : ''}}>Summer</option>
                                        <option value="winter" {{$sale->deal_type == 'winter' ? 'selected' : ''}}>Winter</option>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Update product</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->

    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        category_id_select = document.getElementById('category_id');
        product_id = document.getElementById('productid');
        product_details_div = document.getElementById('product-details-div');
        product_name = document.getElementById('product_name');
        product_slug = document.getElementById('product_slug');
        product_category = document.getElementById('product_category');
        product_brand = document.getElementById('product_brand');
        product_regular_price = document.getElementById('product_regular_price');
        product_sku = document.getElementById('product_sku');
        product_quantity = document.getElementById('product_quantity');
        product_stock = document.getElementById('product_stock');
        product_image = document.getElementById('product_image');

        category_id_select.addEventListener('change' , function(){
            const category_id = this.value;

            if (category_id) {
                fetch(`/add-sale-product/${category_id}`)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    product_id.value = data.id;
                    product_name.value = data.name;
                    product_slug.value = data.slug;
                    product_category.value = data.category.name;
                    product_brand.value = data.brand.name;
                    product_regular_price.value = data.regular_price+ "$";
                    product_sku.value = data.SKU;
                    product_quantity.value = data.quantity;
                    product_stock.value = data.stock_status;
                    product_image.src = `storage/products/${data.image}`;
                    product_details_div.style.display = 'block';
                })
                .catch(() => alert("Failed to fetch product details."));
            } else {
                product_details_div.style.display = 'none';
            }
            
        })
    });
</script> --}}
@endsection