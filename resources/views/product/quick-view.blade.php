<style>
    .filled-heart {
        color: lightcoral;
    }

    .btn-size {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 16px;
        cursor: pointer;
        user-select: none;
        transition: all 0.2s;
    }

    .btn-size span {
        font-size: 14px;
        font-weight: 500;
    }

    .btn-size:hover {
        border-color: #000;
    }

    .btn-size input:checked+span {
        font-weight: bold;
        color: #fff;
        background-color: #000;
        padding: 6px 16px;
        border-radius: 4px;
        display: inline-block;
    }

    .product-single__addtolinks {
        display: block;
        /* thay vì flex, để mọi thứ xếp dọc */
    }

    .product-single__meta-info {
        margin-top: 15px;
        /* tạo khoảng cách với Wishlist/Share */
    }

    .product-single__addtolinks {
        display: flex;
        align-items: center;
        gap: 40px;
        /* khoảng cách giữa Wishlist và Share */
        flex-wrap: wrap;
    }

    .product-single__meta-info {
        flex-basis: 100%;
        /* ép nó chiếm nguyên hàng => xuống dưới */
        margin-top: 10px;
    }

    .swatch-color {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid transparent;
        /* mặc định không viền */
        margin: 6px;
        cursor: pointer;
        transition: border 0.2s ease;
        text-decoration: none;
    }

    /* Khi được chọn */
    .swatch-color.swatch_active {
        border: 2px solid #000;
    }

    /* Khi hover */
    .swatch-color:hover {
        border: 2px solid #aaa;
    }
</style>
<div class="row">
    <div class="col-lg-7">
        <div class="product-single__media" data-media-type="vertical-thumbnail">
            <div class="product-single__image">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide product-single__image-item">
                            <img loading="lazy" class="h-auto"
                                src="{{ asset('uploads/products') }}/{{ $product->image }}" width="674" height="674"
                                alt="{{ $product->name }}" />
                            <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{ $product->image }}"
                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                <svg width="16" height="16" viewBox="0 0 16 16">
                                    <use href="#icon_zoom" />
                                </svg>
                            </a>
                        </div>
                        @foreach (explode(',', $product->images) as $gimg)
                            <div class="swiper-slide product-single__image-item">
                                <img loading="lazy" class="h-auto" src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                    width="674" height="674" alt="{{ $product->name }}" />
                                <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{ $gimg }}"
                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                    <svg width="16" height="16" viewBox="0 0 16 16">
                                        <use href="#icon_zoom" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="product-single__thumbnail">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide product-single__image-item">
                            <img loading="lazy" class="h-auto"
                                src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}" width="104"
                                height="104" alt="{{ $product->name }}" />
                        </div>
                        @foreach (explode(',', $product->images) as $gimg)
                            <div class="swiper-slide product-single__image-item">
                                <img loading="lazy" class="h-auto"
                                    src="{{ asset('uploads/products/thumbnails') }}/{{ $gimg }}" width="104" height="104"
                                    alt="{{ $product->name }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <h1 class="product-single__name">{{ $product->name }}</h1>

        <div class="product-single__price">
            <span class="current-price">
                @if ($product->sale_price)
                    <s>${{ $product->regular_price }}</s> ${{ $product->sale_price }}
                @else
                    ${{ $product->regular_price }}
                @endif
            </span>
        </div>

        <div class="product-single__short-desc">
            <p>{{ $product->short_description }}</p>
        </div>

        {{-- Nút add to cart --}}
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->sale_price ?: $product->regular_price }}">
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit" class="btn btn-primary">Add To Cart</button>
        </form>
    </div>
</div>
