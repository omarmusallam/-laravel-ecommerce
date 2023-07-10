<x-front-layout title="{{ __('Contact Us') }}">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Contact Us') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('Contact-us') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <x-alert type="success" />

                    <div class="col-12">
                        <div class="section-title">
                            <h2>{{ __('Contact Us') }}</h2>
                            <p>There are many variations of passages of Lorem
                                Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="single-info-head">
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-map"></i>
                                    <h3>{{ __('Address') }}</h3>
                                    <ul>
                                        <li>{{ __('Salah-Al-Din Street, Gaza Strip,') }}<br>{{ __('Palestine.') }}</li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-phone"></i>
                                    <h3>{{ __('Call us') }}</h3>
                                    <ul>
                                        <li><a href="tel:+12345678900">+1 234 567 89 00 ({{ __('Toll free') }})</a>
                                        </li>
                                        <li><a href="tel:+58576983200">+5 857 698 32 00</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-envelope"></i>
                                    <h3>{{ __('Email communication') }}</h3>
                                    <ul>
                                        <li><a href="mailto:goldenstore@gmail.com">goldenstore@gmail.com</a>
                                        </li>
                                        <li><a href="mailto:omarrmo2001@gmail.com">omarrmo2001@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-12">
                            <div class="contact-form-head">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <h3>Error Occured!</h3>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-main">
                                    <form class="form" method="POST" action="{{ route('contact.send') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text"
                                                        placeholder="{{ __('Your Name') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="subject" type="text"
                                                        placeholder="{{ __('Your Subject') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email"
                                                        placeholder="{{ __('Your Email') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="phone" type="text"
                                                        placeholder="{{ __('Your Phone') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group message">
                                                    <textarea name="message" placeholder="{{ __('Your Message') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit"
                                                        class="btn">{{ __('Submit Message') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Area -->

</x-front-layout>
