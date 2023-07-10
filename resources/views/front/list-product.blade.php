<x-front-layout title="{{ __('Products') }}">

    <!-- Start Breadcrumbs -->
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title"><a href="{{ route('list-products.index') }}">{{ __('Products') }}</a></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('Shop') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>{{ __('Search Product') }}</h3>
                            <form action="{{ URL::current() }}" method="get">
                                <x-form.input name="slug" placeholder="{{ __('product name...') }}" :value="request('slug')" />
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>{{ __('All Categories') }}</h3>
                            <ul class="list">
                                @if ($categories->count())
                                    @foreach ($categories as $category)
                                        <li>
                                            <a
                                                href="{{ route('list-products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                            <span>({{ $category->products_count }})</span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- End Product Sidebar -->
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">{{ __('Sort by:') }}</label>
                                        <select class="form-control" id="sorting">
                                            <option>{{ __('Recently Added') }}</option>
                                            <option><a href="#">Low - High Price</a></option>
                                            <option><a href="">High - Low Price</a></option>
                                            <option><a href="">A - Z Product</a></option>
                                            <option><a href="">Z - A Product</a></option>
                                        </select>
                                        <h3 class="total-show-product">{{ __('Showing') }}: {{ $products->firstItem() }} -
                                            {{ $products->lastItem() }} {{ __('of') }} {{ $products->total() }} {{ __('items') }}</h3>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i>
                                            </button>
                                            {{-- <button class="nav-link active" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="true"><i
                                                    class="lni lni-list"></i>
                                            </button> --}}
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane show active fade" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <!-- Start Single Product -->
                                            <div class="single-product">
                                                <div class="product-image">
                                                    <img src="{{ $product->image_url }}" alt="#">
                                                    <div class="button">
                                                        <a href="{{ route('products.show', $product->slug) }}"
                                                            class="btn"><i class="lni lni-cart"></i> {{ __('Add to Cart') }}</a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <span class="category">{{ $product->category->name }}</span>
                                                    <h4 class="title">
                                                        <a
                                                            href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                                    </h4>
                                                    <ul class="review">
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><span>4.0 {{ __('Review(s)') }}</span></li>
                                                    </ul>
                                                    <div class="price">
                                                        <span>{{ App\Helpers\Currency::format($product->price) }}</span>
                                                        @if ($product->compare_price)
                                                            <span
                                                                class="discount-price">{{ App\Helpers\Currency::format($product->compare_price) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Product -->
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-5" style="">
                                    {{ $products->withQueryString()->links('pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Product Grids -->


</x-front-layout>
