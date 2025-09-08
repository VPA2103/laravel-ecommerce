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

    .product-main-image {
        position: relative;
    }

    .product-main-image .zoom-btn {
        position: absolute;
        top: 10px;
        /* khoảng cách từ trên xuống */
        right: 10px;
        /* khoảng cách từ phải vào */
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .product-main-image .zoom-btn:hover {
        background: rgba(255, 255, 255, 1);
    }

    .product-main-image {
        position: relative;
        width: 600px;
        height: 600px;
        margin: 30px auto 130px auto;
        /* căn giữa */
        overflow: hidden;
        /* cắt ảnh thừa nếu lồi ra */
    }

    .product-main-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* hoặc 'cover' nếu muốn full khung */
        display: block;
        background: #fff;
        /* nền trắng nếu ảnh không đủ */
    }
</style>
<div class="row">
    <div class="row">
        <div class="col-lg-7">
            <!-- Swiper chính -->
            <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                    {{-- Ảnh chính --}}
                    <div class="swiper-slide product-single__image-item">
                        <img loading="lazy" class="h-auto" src="{{ asset('uploads/products') }}/{{ $product->image }}"
                            width="674" height="674" alt="{{ $product->name }}" />
                        <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{ $product->image }}"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <use href="#icon_zoom" />
                            </svg>
                        </a>
                    </div>

                    {{-- Gallery phụ --}}
                    @foreach (explode(',', $product->images) as $gimg)
                        <div class="swiper-slide product-single__image-item">
                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/products') }}/{{ $gimg }}" width="674"
                                height="674" alt="" />
                            <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{ $gimg }}"
                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                <svg width="16" height="16" viewBox="0 0 16 16">
                                    <use href="#icon_zoom" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Nút điều hướng -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <!-- Swiper thumbnail -->
            <div class="swiper-container gallery-thumbs mt-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img loading="lazy" class="h-auto"
                            src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}" width="104"
                            height="104" alt="{{ $product->name }}" />
                    </div>
                    @foreach (explode(',', $product->images) as $gimg)
                        <div class="swiper-slide">
                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/products/thumbnails') }}/{{ $gimg }}"
                                width="104" height="104" alt="" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>



        <div class="col-lg-5 ">
            <div class="d-flex justify-content-between mb-4 pb-md-2">
                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                    <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                    <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                </div>

                <div
                    class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                    <a href="#" class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_md" />
                        </svg><span class="menu-link menu-link_us-s">Prev</span></a>
                    <a href="#" class="text-uppercase fw-medium"><span class="menu-link menu-link_us-s">Next</span><svg
                            width="10" height="10" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_md" />
                        </svg></a>
                </div><!-- /.shop-acs -->
            </div>
            <h1 class="product-single__name">{{$product->name}}</h1>
            <div class="product-single__rating">
                <div class="reviews-group d-flex">
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                    </svg>
                </div>
                <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
            </div>
            <div class="product-single__price">
                <span class="current-price"> @if($product->sale_price)
                    <s>${{$product->regular_price}} </s> ${{$product->sale_price}}
                @else
                        ${{$product->regular_price}}
                    @endif</span>
            </div>
            <div class="product-single__short-desc">
                <p>{{ $product->short_description }}</p>
            </div>
            @if(Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                <a href="{{route('cart.index')}}" class="btn btn-warning mb-3">Go To Cart</a>
            @else
                <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                    @csrf
                    <div class="product-single__addtocart">
                        <div class="mb-3">
                            <label class="form-label fw-bold d-block">
                                Color: <span id="selectedColorText">None</span>
                            </label>

                            <div class="d-flex flex-wrap gap-2" id="colorSwatches">
                                @foreach($colors as $color)
                                    <a href="javascript:void(0)" class="swatch-color js-filter" data-color="{{ $color }}"
                                        title="{{ ucfirst($color) }}"
                                        style="width:28px; height:28px; border-radius:50%; border:1px solid #ccc; color: {{ $color }};">
                                    </a>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold d-block">
                                    Size: <span id="selectedSizeText">None</span>
                                </label>
                                <div class="d-flex gap-2 flex-wrap">
                                    @foreach($sizes as $size)
                                        <label class="btn-size">
                                            <input type="radio" name="size" value="{{ $size }}" hidden>
                                            <span>{{ $size }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="qty-control position-relative">
                                    <div class="qty-control__reduce">-</div>
                                    <input type="number" name="quantity" value="1" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__increase">+</div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Add
                                    To Cart</button>
                            </div>

                            <input type="hidden" name="id" value="{{$product->id}}" />
                            <input type="hidden" name="name" value="{{$product->name}}" />
                            <input type="hidden" name="price"
                                value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}" />
                            <input type="hidden" name="color" id="inputColor">
                            <input type="hidden" name="size" id="inputSize">
                        </div>
                    </div>
                </form>
            @endif

            <div class="product-single__addtolinks">
                @if(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                    <form method="POST"
                        action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}"
                        id="frm-remove-item">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist filled-heart"
                            onclick="document.getElementById('frm-remove-item').submit();">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                            <span>Remove from Wishlist</span>
                        </a>
                    </form>
                @else
                    <form method="POST" action="{{ route('wishlist.add') }}" id="wishlist-form">
                        @csrf

                        <input type="hidden" name="id" value="{{ $product->id }}" />
                        <input type="hidden" name="name" value="{{ $product->name }}" />
                        <input type="hidden" name="price"
                            value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />
                        <input type="hidden" name="quantity" value="1" />

                        <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist"
                            onclick="document.getElementById('wishlist-form').submit();">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                            <span>Add to Wishlist</span>
                        </a>

                    </form>

                @endif
                <share-button class="share-button">
                    <button class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_sharing" />
                        </svg>
                        <span>Share</span>
                    </button>
                    <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                        <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                        <div id="Article-share-template__main"
                            class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                            <div class="field grow mr-4">
                                <label class="field__label sr-only" for="url">Link</label>
                                <input type="text" class="field__input w-full" id="url"
                                    value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                    placeholder="Link" onclick="this.select();" readonly="">
                            </div>
                            <button class="share-button__copy no-js-hidden">
                                <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                    viewBox="0 0 11 13">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                        fill="currentColor"></path>
                                </svg>
                                <span class="sr-only">Copy link</span>
                            </button>
                        </div>
                    </details>
                </share-button>
                <script src="js/details-disclosure.html" defer="defer"></script>
                <script src="js/share.html" defer="defer"></script>
                <div class="product-single__meta-info d-block">
                    <div class="meta-item">
                        <label>SKU:</label>
                        <span>{{ $product->sku }}</span>
                    </div>
                    <div class="meta-item">
                        <label>Categories:</label>
                        <span>{{ $product->category->name }}</span>
                    </div>
                    <div class="meta-item">
                        <label>Tags:</label>
                        <span>N/A</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- Swiper setup ---
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });

        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });

        // --- Thumbnail click ---
        document.querySelectorAll('.gallery-thumbs .swiper-slide').forEach((thumb, index) => {
            thumb.addEventListener('click', function () {
                galleryTop.slideToLoop(index);
                document.querySelectorAll('.gallery-thumbs .swiper-slide')
                    .forEach(t => t.classList.remove('thumb-active'));
                this.classList.add('thumb-active');
            });
        });
        document.querySelector('.gallery-thumbs .swiper-slide')?.classList.add('thumb-active');


        // --- Xử lý chọn màu ---
        const colorEls = document.querySelectorAll(".swatch-color");
        const selectedColorText = document.getElementById("selectedColorText");
        const inputColor = document.getElementById("inputColor");

        colorEls.forEach(el => {
            el.addEventListener("click", function () {
                const color = this.dataset.color;
                selectedColorText.textContent = color;
                inputColor.value = color;

                colorEls.forEach(c => c.classList.remove('swatch_active'));
                el.classList.add('swatch_active');
            });
        });

        // --- Xử lý chọn size ---
        const sizeEls = document.querySelectorAll("input[name='size']");
        const selectedSizeText = document.getElementById("selectedSizeText"); 
        const inputSize = document.getElementById("inputSize");

        sizeEls.forEach(el => {
            el.addEventListener("change", function () {
                selectedSizeText.textContent = this.value; 
                inputSize.value = this.value;

                document.querySelectorAll('.btn-size')
                    .forEach(label => label.classList.remove('size_active'));
                this.closest('.btn-size').classList.add('size_active');
            });
        });
    });
</script>