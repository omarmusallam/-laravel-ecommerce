<x-front-layout title="{{ __('Register') }}">
    <x-slot:breadcrumb>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Registration') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('Registration') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot:breadcrumb>

    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>{{ __("Don't have an account? Register") }}</h3>
                            <p>{{ __('Registration takes less than a minute but gives you full control over your orders.') }}
                            </p>
                        </div>
                        <form class="row" method="post" action="{{ route('user.register') }}">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">{{ __('User Name') }}</label>
                                    <x-form.input id="reg-fn" name="name" required />
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-ln">Last Name</label>
                                    <x-form.input id="reg-ln" name="last_name" required />
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">{{ __('Email') }}</label>
                                    <x-form.input type="email" id="reg-email" name="email" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-phone">{{ __('Phone Number') }}</label>
                                    <x-form.input type="text" id="reg-phone" name="phone_number" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">{{ __('Password') }}</label>
                                    <x-form.input type="password" id="reg-pass" name="password" required />
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <x-form.input type="password" id="reg-pass-confirm" name="password_confirmation" required />
                                </div>
                            </div> --}}
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Register') }}</button>
                            </div>
                            <p class="outer-link">{{ __('Already have an account?') }} <a
                                    href="{{ route('login') }}">{{ __('Login Now') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->
</x-front-layout>
