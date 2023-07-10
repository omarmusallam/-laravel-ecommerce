<x-front-layout title="{{ __('Forgot Password') }}">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('password.email') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Forgot Password') }}</h3>
                                <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                            </div>
                            <x-auth-session-status class="mb-4" style="color: green" :status="session('status')" />
                            
                            @if ($errors->has(config('fortify.username')))
                                <div class="alert alert-danger">
                                    {{ $errors->first(config('fortify.username')) }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Email Password Reset Link') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
