@extends('layouts.app')
@section('content')
<main class="pt-90">
    <section class="shop-main container d-flex pt-4 pt-xl-5">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
            <div class="aside-header d-flex d-lg-none align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div>

            <div class="pt-4 pt-lg-0"></div>

            <div class="accordion" id="categories-list">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-1">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                            aria-controls="accordion-filter-1">
                            Product Categories
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
                        <div class="accordion-body px-0 pb-0 pt-3">
                            <ul class="list list-inline mb-0 category-list">
                                @foreach ($categories as $category)
                                <li class="list-item">
                                    <div class="p-2">
                                        <form action="{{ route('shop.sort') }}" method="POST"
                                            id="categorysort-{{ $category->id }}">
                                            @csrf
                                            <input type="hidden" name="categoryid" value="{{ $category->id }}">
                                            <a href="javascript:void(0)" class="menu-link py-1" {{
                                                isset($selectedcategory) && $selectedcategory==$category->id ?
                                                "style=font-weight:bold;" : '' }}
                                                onclick="document.getElementById('categorysort-{{ $category->id
                                                }}').submit();">
                                                {{ $category->name }}
                                            </a>
                                            <span class="text-right float-end">
                                                {{ $category->products->count() }}
                                            </span>
                                        </form>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="accordion" id="color-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-1">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true"
                            aria-controls="accordion-filter-2">
                            Color
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-2" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                        <div class="accordion-body px-0 pb-0">
                            <div class="d-flex flex-wrap">
                                <a href="#" class="swatch-color js-filter" style="color: #0a2472"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d7bb4f"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #282828"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #b1d6e8"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #9c7539"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d29b48"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #e6ae95"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d76b67"></a>
                                <a href="#" class="swatch-color swatch_active js-filter" style="color: #bababa"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #bfdcc4"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            {{-- <div class="accordion" id="size-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-size">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true"
                            aria-controls="accordion-filter-size">
                            Sizes
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-size" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                        <div class="accordion-body px-0 pb-0">
                            <div class="d-flex flex-wrap">
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XS</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">S</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">M</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">L</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XL</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XXL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <div class="accordion" id="brand-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-brand">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                            aria-controls="accordion-filter-brand">
                            Brands
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                        <div class="search-field multi-select accordion-body px-0 pb-0">
                            <form action="{{ route('shop.sort') }}" method="POST" id="filterForm">
                                @csrf
                                <ul class="list list-inline mb-0 brand-list">
                                    @foreach ($brands as $brand)
                                    <div class="mb-2">
                                        <li class="list-item d-flex align-items-center p-2">
                                            <input type="checkbox" name="brands[]" value="{{$brand->id}}"
                                                class="form-check-input me-2" id="brand-{{$loop->index}}"
                                                onchange="document.getElementById('filterForm').submit();" {{
                                                in_array($brand->id, $selectedBrands ?? []) ? 'checked' : '' }}>
                                            <label for="brand-{{$loop->index}}"
                                                class="mb-0 me-auto">{{$brand->name}}</label>
                                            <span class="text-muted small">{{$brand->products->count()}}</span>
                                        </li>
                                    </div>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="accordion" id="price-filters">
                <div class="accordion-item mb-4">
                    <h5 class="accordion-header mb-2" id="accordion-heading-price">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true"
                            aria-controls="accordion-filter-price">
                            Price
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <section class="category-banner container">
                        <form id="price_filter_form" method="POST" action="{{ route('shop.sort') }}">
                            @csrf
                            <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
                                aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                                <input class="price-range-slider" type="text" name="price_range" value=""
                                    data-slider-min="5" data-slider-max="600" data-slider-step="5"
                                    data-slider-value="[{{$minprice ?? 10}},{{$maxprice ?? 450}}]"
                                    data-currency="&#8377;" onchange="pricesubmit()" />

                                <!-- Hidden form fields for min and max price -->
                                <input type="hidden" name="price_min" id="price_min" value="{{$minprice ?? 10}}">
                                <input type="hidden" name="price_max" id="price_max" value="{{$maxprice ?? 450}}">

                                <div class="price-range__info d-flex align-items-center mt-2">
                                    <div class="me-auto">
                                        <span class="text-secondary">Min Price: </span>
                                        <span class="price-range__min" id="min-price">&#8377;{{$minprice ?? 10}}</span>
                                    </div>
                                    <div>
                                        <span class="text-secondary">Max Price: </span>
                                        <span class="price-range__max" id="max-price">&#8377;{{$maxprice ?? 450}}</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="shop-list flex-grow-1">
            <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": 1,
                "effect": "fade",
                "loop": true,
                "pagination": {
                  "el": ".slideshow-pagination",
                  "type": "bullets",
                  "clickable": true
                }
              }'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                            <div class="slide-split_text position-relative d-flex align-items-center"
                                style="background-color: #f5e6e0;">
                                <div class="slideshow-text container p-3 p-xl-5">
                                    <h2
                                        class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                        Men's <br /><strong>ACCESSORIES</strong></h2>
                                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the
                                        best way to
                                        update your look. Add a title edge with new styles and new colors, or go for
                                        timeless pieces.</h6>
                                </div>
                            </div>
                            <div class="slide-split_media position-relative">
                                <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                    <img loading="lazy" src="{{asset('assets/images/home/demo3/product-4.jpg')}}"
                                        width="630" height="450" alt="Women's accessories"
                                        class="slideshow-bg__img object-fit-cover" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                            <div class="slide-split_text position-relative d-flex align-items-center"
                                style="background-color: #f5e6e0;">
                                <div class="slideshow-text container p-3 p-xl-5">
                                    <h2
                                        class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                        Women's <br /><strong>ACCESSORIES</strong></h2>
                                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the
                                        best way to
                                        update your look. Add a title edge with new styles and new colors, or go for
                                        timeless pieces.</h6>
                                </div>
                            </div>
                            <div class="slide-split_media position-relative">
                                <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                    <img loading="lazy" src="assets/images/shop/shop_banner3.jpg" width="630"
                                        height="450" alt="Women's accessories"
                                        class="slideshow-bg__img object-fit-cover" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                            <div class="slide-split_text position-relative d-flex align-items-center"
                                style="background-color: #f5e6e0;">
                                <div class="slideshow-text container p-3 p-xl-5">
                                    <h2
                                        class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                        Women's <br /><strong>ACCESSORIES</strong></h2>
                                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the
                                        best way to
                                        update your look. Add a title edge with new styles and new colors, or go for
                                        timeless pieces.</h6>
                                </div>
                            </div>
                            <div class="slide-split_media position-relative">
                                <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                    <img loading="lazy" src="assets/images/shop/shop_banner3.jpg" width="630"
                                        height="450" alt="Women's accessories"
                                        class="slideshow-bg__img object-fit-cover" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container p-3 p-xl-5">
                    <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2">

                    </div>
                </div>
            </div>

            <div class="mb-3 pb-2 pb-xl-3"></div>

            <div class="d-flex justify-content-between mb-4 pb-md-2">
                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                    <a href="/" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                    <a href="javascript:void(0)" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                </div>

                @if ($products->count() > 0)
                <div
                    class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                    <form action="{{ route('shop.sort') }}" method="POST" id="sortingForm">
                        @csrf
                        <select name="sorting"
                            class="shop-acs__select p-3 form-select w-auto border-0 py-0 order-1 order-md-0"
                            aria-label="Sort Items" onchange="document.getElementById('sortingForm').submit();">
                            <option value="default" {{$sortOption=="default" ? "selected" : "" }} disabled>Default
                                Sorting</option>
                            <option value="featured" {{$sortOption=="featured" ? "selected" : "" }}>Featured</option>
                            <option value="name-asc" {{$sortOption=="name-asc" ? "selected" : "" }}>Alphabetically, A-Z
                            </option>
                            <option value="name-desc" {{$sortOption=="name-desc" ? "selected" : "" }}>Alphabetically,
                                Z-A</option>
                            <option value="price-asc" {{$sortOption=="price-asc" ? "selected" : "" }}>Price, low to high
                            </option>
                            <option value="price-desc" {{$sortOption=="price-desc" ? "selected" : "" }}>Price, high to
                                low</option>
                            <option value="date-asc" {{$sortOption=="date-asc" ? "selected" : "" }}>Date, old to new
                            </option>
                            <option value="date-desc" {{$sortOption=="date-desc" ? "selected" : "" }}>Date, new to old
                            </option>
                        </select>
                    </form>

                    {{-- <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div> --}}

                    {{-- <div class="col-size align-items-center order-1 d-none d-lg-flex">
                        <span class="text-uppercase fw-medium me-2">View</span>
                        <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                            data-cols="2">2</button>
                        <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                            data-cols="3">3</button>
                        <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                            data-cols="4">4</button>
                    </div> --}}

                    <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                        <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                            data-aside="shopFilter">
                            <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_filter" />
                            </svg>
                            <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                        </button>
                    </div>
                </div>
                @endif
            </div>

            @if ($products->count() == 0)
            <div class="text-center">
                <h2>NO PRODUCT FOUND</h2>
            </div>
            @else
            <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                @foreach ($products as $product)
                <div class="product-card-wrapper">
                    <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                        <div class="pc__img-wrapper">
                            <div class="swiper-container background-img js-swiper-slider"
                                data-settings='{"resizeObserver": true}'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="{{route('product.detail',$product->slug)}}">
                                            <img loading="lazy"
                                                src="{{ Storage::disk('s3')->url('products/'.$product->image) }}"
                                                width="330" height="400" alt="{{$product->name}}" class="pc__img">
                                        </a>
                                    </div>
                                    @if ($product->images)
                                    @foreach (explode(',',$product->images) as $image)
                                    <div class="swiper-slide">
                                        <a href="{{route('product.detail',$product->slug)}}">
                                            <img loading="lazy" src="{{ Storage::disk('s3')->url('products/'.$image) }}"
                                                width="330" height="400" alt="{{$product->name}}" class="pc__img">
                                        </a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></span>
                                <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></span>
                            </div>
                            @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                            <a href="/cart"
                                class="btn btn-danger pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart">GO
                                TO CART</a>
                            @else
                            <form name="addtocart-form" method="POST" action="{{route('cart.add')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="quantity" value="1">
                                <button
                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart"
                                    data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                            </form>
                            @endif
                        </div>

                        <div class="pc__info position-relative">
                            <p class="pc__category">{{$product->category->name}}</p>
                            <h6 class="pc__title">
                                <a href="{{route('product.detail',$product->slug)}}">{{$product->name}} </a>
                            </h6>
                            <div class="product-card__price d-flex">
                                <span class="money price">
                                    @if ($sales_product_id->contains($product->id))
                                    <s>&#8377;{{$product->regular_price}}</s> &#8377;{{$product->sale->deal_price}}
                                    @elseif($product->sale_price)
                                    <s>&#8377;{{$product->regular_price}}</s> &#8377;{{$product->sale_price}}
                                    @else
                                    &#8377;{{$product->regular_price}}
                                    @endif
                                </span>
                            </div>
                            @if($wishlists->contains('product_id',$product->id))
                            <form action="{{route('wishlist.remove')}}" method="post"
                                id="wishlistremove-{{$product->id}}">
                                @csrf
                                <input type="hidden" name="productid" value="{{$product->id}}">
                                <button type="submit"
                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 filled-heart"
                                    title="Remove from Wishlist" style="color: red">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg>
                                </button>
                            </form>
                            @else
                            <form action="{{route('wishlist.add')}}" method="post" id="wishlistadd-{{$product->id}}">
                                @csrf
                                <input type="hidden" name="productid" value="{{$product->id}}">
                                <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0"
                                    title="Add To Wishlist" type="submit"
                                    onclick="document.getElementById('wishlistadd-{{$product->id}}').submit();">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>
                        <div class="pc-labels position-absolute top-0 start-0 w-100 d-flex justify-content-between">
                            <div class="pc-labels__right ms-auto">
                                <span class="pc-label pc-label_sale d-block text-white">
                                    @if ($sales_product_id->contains($product->id))
                                    -{{ number_format((($product->regular_price - $product->sale->deal_price) /
                                    $product->regular_price) * 100, 0) }}%
                                    @elseif($product->sale_price)
                                    -{{ number_format((($product->regular_price - $product->sale_price) /
                                    $product->regular_price) * 100, 0) }}%
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <nav class="shop-pages  mt-3" aria-label="Page navigation">
                <div>
                    {{$products->links()}}
                </div>
            </nav>
        </div>
    </section>
</main>
<script>
    let timer;

    function pricesubmit() {
        clearTimeout(timer);

        timer = setTimeout(function() {
            let price_range = document.querySelector('.price-range-slider');
            let minPrice = document.getElementById('min-price');
            let maxPrice = document.getElementById('max-price');
            
            let sliderValues = price_range.value.split(',');
            let minValue = sliderValues[0].trim();
            let maxValue = sliderValues[1].trim();

            document.getElementById('price_min').value = minValue;
            document.getElementById('price_max').value = maxValue;

            document.getElementById('price_filter_form').submit();
        }, 2000); 
    }
</script>
@endsection