@extends('layouts.app')
@section('content')
<main>
    <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="overflow-hidden position-relative h-100">
                    <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                        <img loading="lazy" src="{{asset('storage/slider/'.$slider->image)}}" width="542" height="733"
                            alt="Woman Fashion 1"
                            class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                        <div class="character_markup type2">
                            <p
                                class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                                {{$slider->tagline}}</p>
                        </div>
                    </div>
                    <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                        <h6
                            class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                            New Arrivals</h6>
                        <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">
                            {{$slider->title}}
                        </h2>
                        <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">{{$slider->subtitle}}
                        </h2>
                        <a href="{{$slider->link}}"
                            class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                            Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="container">
            <div
                class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
            </div>
        </div>
    </section>
    <div class="container mw-1620 bg-white border-radius-10">
        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
        <section class="category-carousel container">
            <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">You Might Like</h2>

            <div class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "effect": "none",
              "loop": true,
              "navigation": {
                "nextEl": ".products-carousel__next-1",
                "prevEl": ".products-carousel__prev-1"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 15
                },
                "768": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "spaceBetween": 30
                },
                "992": {
                  "slidesPerView": 6,
                  "slidesPerGroup": 1,
                  "spaceBetween": 45,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 8,
                  "slidesPerGroup": 1,
                  "spaceBetween": 60,
                  "pagination": false
                }
              }
            }'>
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <form action="{{route('shop.sort')}}" method="post" id="category_form-{{$category->id}}">
                                @csrf
                                <a href="javascript:void(0)"
                                    onclick="document.getElementById('category_form-{{$category->id}}').submit()">
                                    <input type="hidden" name="categoryid" value="{{$category->id}}">
                                    <img loading="lazy" class="w-100 h-auto mb-3"
                                        src="{{asset('storage/categories/'.$category->image)}}" width="124" height="124"
                                        alt="" />
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="menu-link fw-medium">{{$category->name}}</a>
                                    </div>
                                </a>
                            </form>
                        </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->
            </div><!-- /.position-relative -->
        </section>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        @if ($salesproduct->count()>0)
        <section class="hot-deals container">
            <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Hot Deals</h2>
            <div class="row">
                <div
                    class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
                    <h2>Summer Sale</h2>
                    <h2 class="fw-bold">Up to 60% Off</h2>

                    <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
                        data-date="18-3-2024" data-time="06:50">
                        <div class="day countdown-unit">
                            <span class="countdown-num d-block"></span>
                            <span class="countdown-word text-uppercase text-secondary">Days</span>
                        </div>

                        <div class="hour countdown-unit">
                            <span class="countdown-num d-block"></span>
                            <span class="countdown-word text-uppercase text-secondary">Hours</span>
                        </div>

                        <div class="min countdown-unit">
                            <span class="countdown-num d-block"></span>
                            <span class="countdown-word text-uppercase text-secondary">Mins</span>
                        </div>

                        <div class="sec countdown-unit">
                            <span class="countdown-num d-block"></span>
                            <span class="countdown-word text-uppercase text-secondary">Sec</span>
                        </div>
                    </div>

                    <a href="#" class="btn-link default-underline text-uppercase fw-medium mt-3">View All</a>
                </div>
                <div class="col-md-6 col-lg-8 col-xl-80per">
                    <div class="position-relative">
                        <div class="swiper-container js-swiper-slider" data-settings='{
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": 4,
                                "slidesPerGroup": 4,
                                "effect": "none",
                                "loop": false,
                                "breakpoints": {
                                    "320": {
                                    "slidesPerView": 2,
                                    "slidesPerGroup": 2,
                                    "spaceBetween": 14
                                    },
                                    "768": {
                                    "slidesPerView": 2,
                                    "slidesPerGroup": 3,
                                    "spaceBetween": 24
                                    },
                                    "992": {
                                    "slidesPerView": 3,
                                    "slidesPerGroup": 1,
                                    "spaceBetween": 30,
                                    "pagination": false
                                    },
                                    "1200": {
                                    "slidesPerView": 4,
                                    "slidesPerGroup": 1,
                                    "spaceBetween": 30,
                                    "pagination": false
                                    }
                                }
                                }'>
                            <div class="swiper-wrapper">
                                @foreach ($salesproduct as $sale)
                                <div class="swiper-slide product-card product-card_style3">
                                    <div class="pc__img-wrapper">
                                        <a href="{{route('product.detail',$sale->product->slug)}}">
                                            <img loading="lazy" alt="" width="258" height="313"
                                                src="{{asset('storage/products/'.$sale->product->image)}}"
                                                class="pc__img">
                                            {{-- <img loading="lazy"
                                                src="{{asset('storage/product/'.$sale->product->images)}}" width="258"
                                                height="313" alt="" class="pc__img pc__img-second"> --}}
                                        </a>
                                    </div>

                                    <div class="pc__info position-relative">
                                        <h6 class="pc__title">
                                            <a
                                                href="{{route('product.detail',$sale->product->slug)}}">{{$sale->product->name}}</a>
                                        </h6>
                                        <div class="product-card__price d-flex">
                                            <span class="money price text-secondary">
                                                <s>&#8377;{{$sale->regular_price}}</s> &#8377;{{$sale->deal_price}}
                                            </span>
                                        </div>
                                        <div
                                            class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                                            @if(Cart::instance('cart')->content()->where('id',$sale->product_id)->count()>0)
                                            <a href="/cart"
                                                class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart"
                                                data-aside="cartDrawer" title="Go To Cart">GO
                                                TO CART</a>
                                            @else
                                            <form name="addtocart-form" method="POST" action="{{route('cart.add')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$sale->product_id}}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button
                                                    class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart"
                                                    data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                                            </form>
                                            @endif
                                            <a href="{{route('product.detail',$sale->product->slug)}}">
                                                <button
                                                    class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                                    data-bs-toggle="modal" data-bs-target="#quickView"
                                                    title="Quick view">
                                                    <span class="d-none d-xxl-block">Quick View</span>
                                                    <span class="d-block d-xxl-none">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <use href="#icon_view" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </a>
                                            @if($wishlists->contains('product_id',$sale->product_id))
                                            <form action="{{route('wishlist.remove')}}" method="post"
                                                id="wishlistremove-{{$sale->product_id}}">
                                                @csrf
                                                <input type="hidden" name="productid" value="{{$sale->product_id}}">
                                                <button type="submit"
                                                    class="pc__btn-wl bg-transparent border-0 js-add-wishlist filled-heart"
                                                    title="Remove from Wishlist" style="color: red">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @else
                                            <form action="{{route('wishlist.add')}}" method="post"
                                                id="wishlistadd-{{$sale->product_id}}">
                                                @csrf
                                                <input type="hidden" name="productid" value="{{$sale->product_id}}">
                                                <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
                                                    title="Add To Wishlist" type="submit"
                                                    onclick="document.getElementById('wishlistadd-{{$sale->product_id}}').submit();">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div><!-- /.swiper-wrapper -->
                        </div><!-- /.swiper-container js-swiper-slider -->
                    </div><!-- /.position-relative -->
                </div>
            </div>
        </section>
        @endif

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        <section class="category-banner container">
            <div class="row">
                @foreach ($bestcategories as $category)
                @if ($category->first_product)
                <div class="col-md-6 p-5">
                    <div class="category-banner__item border-radius-10 mb-5">
                        <img loading="lazy" src="{{ asset('storage/products/' . $category->first_product->image) }}"
                            width="690" height="665" alt="{{ $category->first_product->name }}" />
                        <div class="category-banner__item-mark">
                            Starting at &#8377;{{ $category->first_product->sale_price }}
                        </div>
                        <div class="category-banner__item-content">
                            <h3 class="mb-0">{{ $category->name }}</h3>
                            <form action="{{ route('shop.sort') }}" method="POST" id="categorysort-{{ $category->id }}">
                                @csrf
                                <input type="hidden" name="categoryid" value="{{ $category->id }}">
                                <a href="javascript:void(0)" class="btn-link default-underline text-uppercase fw-medium"
                                    onclick="document.getElementById('categorysort-{{ $category->id
                                                                }}').submit();">
                                    Shop Now
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </section>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        @if ($featuredproducts->count() > 0)
        <section class="products-grid container">
            <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>

            <div class="row">
                @foreach ($featuredproducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                        <div class="pc__img-wrapper">
                            <a href="{{route('product.detail',$product->slug)}}">
                                <img loading="lazy" src="{{asset('storage/products/'.$product->image)}}" width="330"
                                    height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                            </a>
                        </div>

                        <div class="pc__info position-relative">
                            <h6 class="pc__title">
                                <a href="{{route('product.detail',$product->slug)}}">{{$product->name}}</a>
                            </h6>
                            <div class="product-card__price d-flex align-items-center">
                                <span class="money price text-secondary">
                                    @if ($sales_product_id->contains($product->id))
                                    <s>&#8377;{{$product->regular_price}}</s> &#8377;{{$product->sale->deal_price}}
                                    @elseif($product->sale_price)
                                    <s>&#8377;{{$product->regular_price}}</s> &#8377;{{$product->sale_price}}
                                    @else
                                    &#8377;{{$product->regular_price}}
                                    @endif
                                </span>
                            </div>

                            <div
                                class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                                @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                                <a href="/cart" class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart"
                                    data-aside="cartDrawer" title="Go To Cart">GO
                                    TO CART</a>
                                @else
                                <form name="addtocart-form" method="POST" action="{{route('cart.add')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart"
                                        data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                                </form>
                                @endif
                                <a href="{{route('product.detail',$product->slug)}}">
                                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                        data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                                        <span class="d-none d-xxl-block">Quick View</span>
                                        <span class="d-block d-xxl-none">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_view" />
                                            </svg>
                                        </span>
                                    </button>
                                </a>
                                @if($wishlists->contains('product_id',$product->id))
                                <form action="{{route('wishlist.remove')}}" method="post"
                                    id="wishlistremove-{{$product->id}}">
                                    @csrf
                                    <input type="hidden" name="productid" value="{{$product->id}}">
                                    <button type="submit"
                                        class="pc__btn-wl bg-transparent border-0 js-add-wishlist filled-heart"
                                        title="Remove from Wishlist" style="color: red">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </form>
                                @else
                                <form action="{{route('wishlist.add')}}" method="post"
                                    id="wishlistadd-{{$product->id}}">
                                    @csrf
                                    <input type="hidden" name="productid" value="{{$product->id}}">
                                    <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.row -->

            <div class="text-center mt-2">
                <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium" href="/shop">Shop Now</a>
            </div>
        </section>
        @endif
    </div>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

</main>
@endsection