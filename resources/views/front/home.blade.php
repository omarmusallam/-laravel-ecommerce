<x-front-layout>
    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container">
            <x-alert type="info" />
            <x-alert type="success" />
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image:url({{ asset('assets/images/parfums4.jpg') }})">
                                <div class="content">
                                    <h2>
                                        {{ $product4->name }}
                                    </h2>
                                    <p style="color: white">{{ $product4->description }}</p>
                                    <h3>{{ App\Helpers\Currency::format($product4->price) }}</h3>
                                    <div class="button">
                                        <a href="{{ route('list-products.index') }}"
                                            class="btn">{{ __('Shop Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner"
                                style="background-image:url({{ $product5->image_url }}); background-size: 70%">
                                <div class="content" style="margin-top: 30px">
                                    <h2 style="font-size: 17px" dir="rtl">
                                        {{ $product5->name }}
                                    </h2>
                                    <h3 style="font-size: 17px" dir="rtl">
                                        {{ App\Helpers\Currency::format($product5->price) }}</h3>
                                    <div class="button" style="padding-top: 30px; border-radius: 5px;">
                                        <a class="btn" style="background-color: #000; color: #fff" dir="rtl"
                                            href="{{ route('list-products.index') }}">{{ __('Shop Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2 style="font-size: 17px" dir="rtl">{{ __('تخفيضات مستمرة!') }}</h2>
                                    <p style="font-size: 17px" dir="rtl">
                                        {{ __('خصم ما يصل إلى 50٪ من جميع عناصر المتجر على الإنترنت.') }}</p>
                                    <div class="button">
                                        <a class="btn"
                                            href="{{ route('list-products.index') }}">{{ __('Shop Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Recommended for you -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Recommended for you') }}</h2>
                        <p>{{ __('Discover our hand-picked collection of top-rated products designed just for you, We take pride in providing the best items that perfectly match your preferences and needs.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Recommended Added Area -->

    <!-- Start Banner Area -->
    <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner"
                        style="background-image:url({{ $product6->image_url }}); background-size: 100%">
                        <div class="content">
                            <h2>{{ $product6->name }}</h2>
                            {{-- <p style="color: white">Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p> --}}
                            <div class="button">
                                <a href="{{ route('list-products.index') }}" class="btn">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner custom-responsive-margin"
                        style="background-image:url({{ $product7->image_url }}); background-size: 100%">
                        <div class="content">
                            <h2>{{ $product7->name }}</h2>
                            {{-- <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                incididunt ut labore.</p> --}}
                            <div class="button">
                                <a href="{{ route('list-products.index') }}" class="btn">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Recently Added Area -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ __('Recently Added') }}</h2>
                        <p>{{ __('Explore our latest additions to our collection, We are constantly updating our product range to bring you the latest and most innovative items in the market.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach ($products2 as $product)
                            <div class="col-lg-4 col-md-6 col-12">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                    <!-- Start Banner -->
                    <div class="single-banner right"
                        style="background-image:url({{ $product8->image_url }});margin-top: 30px;">
                        <div class="content">
                            <h2>{{ $product8->name }}</h2>
                            <p>{{ $product8->description }}</p>
                            <div class="price">
                                <span>{{ App\Helpers\Currency::format($product8->price) }}</span>
                            </div>
                            <div class="button">
                                <a href="{{ route('products.show', $product8->slug) }}"
                                    class="btn">{{ __('Add to Cart') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ $product3->image_url }}" alt="#">
                            @if ($product3->sale_percent)
                                <span class="sale-tag">-{{ $product3->sale_percent }}%</span>
                            @endif
                        </div>

                        <div class="text">
                            <h2><a href="{{ route('products.show', $product3->slug) }}">{{ $product3->name }}</a></h2>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 {{ __('Review(s)') }}</span></li>
                            </ul>
                            <div class="price">
                                <span>{{ App\Helpers\Currency::format($product3->price) }}</span>
                                <span
                                    class="discount-price">{{ App\Helpers\Currency::format($product3->compare_price) }}</span>
                            </div>
                            <p>{{ $product3->description }}</p>

                            <div class="button" style="display: flex; justify-content: center; align-items: center;">
                                <a href="{{ route('products.show', $product3->slug) }}" class="btn"><i
                                        class="lni lni-cart"></i>{{ __('Add to Cart') }}</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Recently for you -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Free Shipping.') }}</h5>
                        <span>{{ __('Shop now at no additional cost.') }}</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('24/7 Support.') }}</h5>
                        <span>{{ __('Live Chat Or Call.') }}</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Online Payment.') }}</h5>
                        <span>{{ __('Secure Payment Services.') }}</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>{{ __('Easy Return.') }}</h5>
                        <span>{{ __('Hassle Free Shopping.') }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

    @push('scripts')
        <script type="text/javascript">
            //========= Hero Slider 
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });

            //======== Brand Slider
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 15,
                nav: false,
                controls: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    540: {
                        items: 3,
                    },
                    768: {
                        items: 5,
                    },
                    992: {
                        items: 6,
                    }
                }
            });
        </script>
        <script>
            const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

            const timer = () => {
                const now = new Date().getTime();
                let diff = finaleDate - now;
                if (diff < 0) {
                    document.querySelector('.alert').style.display = 'block';
                    // document.querySelector('.container').style.display = 'none';
                }

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
                let seconds = Math.floor(diff % (1000 * 60) / 1000);

                days <= 99 ? days = `0${days}` : days;
                days <= 9 ? days = `00${days}` : days;
                hours <= 9 ? hours = `0${hours}` : hours;
                minutes <= 9 ? minutes = `0${minutes}` : minutes;
                seconds <= 9 ? seconds = `0${seconds}` : seconds;

                document.querySelector('#days').textContent = days;
                document.querySelector('#hours').textContent = hours;
                document.querySelector('#minutes').textContent = minutes;
                document.querySelector('#seconds').textContent = seconds;

            }
            timer();
            setInterval(timer, 1000);
        </script>
    @endpush

</x-front-layout>
