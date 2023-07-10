<x-front-layout title="{{ __('About Us') }}">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('About Us') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('About-us') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="content-left">
                        <img src="https://via.placeholder.com/540x420" alt="#">
                        <a href="https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
                            class="glightbox video"><i class="lni lni-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right">
                        <h2>{{ __('Golden Store - Perfumes & Gifts.') }}</h2>
                        <p>{{ __('We are an online store for oud, incense, oriental and western perfumes. High quality and varied products for lovers of luxurious scents. Our collection is distinguished by its diversity and distinction, as it offers a wide variety of perfumes, essential oils, oud and incense. If you are looking for simple options, this experience makes you feel like you are in for a unique experience.') }}
                        </p>
                        <p>{{ __('We are keen to provide luxurious and original products, as we work with the most famous brands in the world of perfumes, incense and oud. We offer you an exceptional experience from our carefully selected collection, which combines cultural heritage with modern designs.') }}
                        </p>
                        <p>{{ __('We strive to serve your shopping, strive to provide excellent service. Our helpful and professional team is ready to assist you and answer your inquiries, whether from products or purchases.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Team Area -->
    {{-- <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ __('Our Core Team') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Grace Wright</h3>
                                <h5>Founder, CEO</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Taylor Jackson</h3>
                                <h5>Financial Director</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Quinton Cross</h3>
                                <h5>Marketing Director</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Team -->
                    <div class="single-team">
                        <div class="image">
                            <img src="https://via.placeholder.com/300x300" alt="#">
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Liana Mullen</h3>
                                <h5>Lead Designer</h5>
                                <ul class="social">
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team -->
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Team Area -->
</x-front-layout>
