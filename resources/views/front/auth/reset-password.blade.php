<x-front-layout title="Login">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    @if ($errors->has(config('fortify.username')))
                        <div class="alert alert-danger">
                            {{ $errors->first(config('fortify.username')) }}
                        </div>
                    @endif
                    <form class="card login-form" action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="card-body">
                            <div class="title">
                                <h3>Reset Password</h3>
                            </div>
                            <div class="form-group input-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email" required
                                    autofocus />
                            </div>
                            <div class="form-group input-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" required />
                            </div>
                            <div class="form-group input-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" required />
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
