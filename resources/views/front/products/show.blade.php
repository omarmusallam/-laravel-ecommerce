<x-front-layout :title="$product->name">
    <style>
        .toast {
            background-color: #0167F3;
            color: #fff;
        }

        .toast-close-button {
            color: #fff;
        }
    </style>
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $product->name }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ $product->image_url }}" id="current" alt="#">
                                </div>
                                <div class="images">
                                    @if ($product->images)
                                        @foreach ($product->images as $image)
                                            <img src="{{ $image->image_url }}" class="img" alt="#">
                                        @endforeach
                                    @endif
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $product->name }}</h2>
                            <p class="category"><i class="lni lni-tag"></i> {{ __('Brand') }}:<a
                                    href="javascript:void(0)">{{ $product->category->name }}</a></p>
                            <h3 class="price">{{ Currency::format($product->price) }}@if ($product->compare_price)
                                    <span>{{ Currency::format($product->compare_price) }}</span>
                                @endif
                            </h3>
                            <p class="info-text">{{ $product->description }}</p>
                            <form action="{{ route('cart.store') }}" method="post" id="cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="button cart-button mt-50">
                                            <a class="btn" id="add-to-cart" href="#"
                                                style="width: 100%;">{{ __('Add to Cart') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group quantity">
                                            <label for="color">{{ __('Quantity') }}</label>
                                            <select class="form-control" name="quantity">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Item Details -->

    @push('scripts')
        <script type="text/javascript">
            const current = document.getElementById("current");
            const opacity = 0.6;
            const imgs = document.querySelectorAll(".img");
            imgs.forEach(img => {
                img.addEventListener("click", (e) => {
                    //reset opacity
                    imgs.forEach(img => {
                        img.style.opacity = 1;
                    });
                    current.src = e.target.src;
                    //adding class 
                    //current.classList.add("fade-in");
                    //opacity
                    e.target.style.opacity = opacity;
                });
            });
        </script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush

</x-front-layout>
