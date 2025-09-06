@extends('layouts.admin')

@section('content')
    <style>
        select.form-control,
        select.form-select {
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 10px;
        }
    </style>
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Product Variant Information</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products-variant') }}">
                            <div class="text-tiny">Product Variant</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add Product Variant</div>
                    </li>
                </ul>
            </div>

            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.products-variant.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Product Name <span class="tf-color-1">*</span></div>
                        <select name="product_id" class="form-control" required>
                            <option value="">Choose Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>
                    @error('product_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Color <span class="tf-color-1">*</span></div>
                        <select name="color" class="form-select" required>
                            <option value="">Choose Color</option>
                            @foreach($colors as $color)
                                <option value="{{ strtolower($color) }}" {{ (isset($products_variant) && strtolower($products_variant->color ?? '') === strtolower($color)) ? 'selected' : '' }}>
                                    {{ $color }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>

                    @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Size <span class="tf-color-1">*</span></div>
                        <select name="size" class="form-control" required>
                            <option value="">Choose Zize</option>
                            <option value="S" {{ (isset($products_variant) && $products_variant->size == 'XS') ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ (isset($products_variant) && $products_variant->size == 'S') ? 'selected' : '' }}>S</option>
                            <option value="M" {{ (isset($products_variant) && $products_variant->size == 'M') ? 'selected' : '' }}>M</option>
                            <option value="L" {{ (isset($products_variant) && $products_variant->size == 'L') ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ (isset($products_variant) && $products_variant->size == 'XL') ? 'selected' : '' }}>XL</option>
                            <option value="XL" {{ (isset($products_variant) && $products_variant->size == 'XXL') ? 'selected' : '' }}>XXL</option>
                            <option value="XL" {{ (isset($products_variant) && $products_variant->size == 'XXXL') ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </fieldset>
                    @error('size')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Price <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="number" step="0.01" placeholder="Product variant price" name="price"
                            value="{{ $products_variant->price ?? '' }}" required>
                    </fieldset>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Stock <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="number" placeholder="Product variant stock" name="stock"
                            value="{{ $products_variant->stock ?? '' }}" required>
                    </fieldset>
                    @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <!-- Submit -->

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

    <script>
        $(function () {
            $('#myFile').on('change', function (e) {
                const photoInp = $("#myFile");
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr("src", URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("input[name='name']").on('keyup', function () {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            })


        })

        function StringToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w]+/g, '')
                .replace(/ +/g, '-');
        }
        $(function () {
            // Xem trước ảnh chính
            $('#myFile').on('change', function (e) {
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr("src", URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            // Xem trước gallery
            $('#gFile').on('change', function (e) {
                const gphotos = this.files;
                $.each(gphotos, function (key, val) {
                    $("#galUpload").prepend(`
                            <div class="item gitems">
                                <img src="${URL.createObjectURL(val)}"/>
                            </div>
                        `);
                });
            });

            // Tự động tạo slug khi nhập tên
            $("input[name='name']").on('input', function () {
                $("input[name='slug']").val(stringToSlug($(this).val()));
            });
        });

        function stringToSlug(text) {
            return text.toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // bỏ dấu tiếng Việt
                .replace(/[^\w\s-]/g, '') // bỏ ký tự đặc biệt
                .trim()
                .replace(/\s+/g, '-');
        }

        let variantIndex = 1;
        function addVariant() {
            let html = `
                <div class="variant border p-3 rounded mb-3">
                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Color <span class="tf-color-1">*</span></div>
                            <input type="text" name="variants[${variantIndex}][color]" placeholder="Enter color" required>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Size <span class="tf-color-1">*</span></div>
                            <input type="text" name="variants[${variantIndex}][size]" placeholder="Enter size" required>
                        </fieldset>
                    </div>
                    <div class="cols gap22">
                        <fieldset>
                            <div class="body-title mb-10">Price</div>
                            <input type="number" name="variants[${variantIndex}][price]" placeholder="Variant price">
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Quantity</div>
                            <input type="number" name="variants[${variantIndex}][quantity]" placeholder="Variant quantity">
                        </fieldset>
                    </div>
                </div>`;
            $("#variants").append(html);
            variantIndex++;
        }
    </script>

@endpush