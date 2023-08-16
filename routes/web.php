<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ImagesController;
use App\Http\Controllers\Front\ListProductsController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\UserProfileController;
use App\Http\Controllers\SendSms;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StripeWebhooksController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
], function () {

    Route::get('user-profile', [UserProfileController::class, 'edit'])->name('user-profile.edit');
    Route::patch('user-profile', [UserProfileController::class, 'update'])->name('user-profile.update');

    Route::get('user/register', [UserProfileController::class, 'create'])->name('user.register');
    Route::post('user/register', [UserProfileController::class, 'store'])->name('user.register');

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/products', [ProductsController::class, 'index'])
        ->name('products.index');

    Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
        ->name('products.show');

    Route::resource('cart', CartController::class);

    Route::get('checkout', [CheckoutController::class, 'create'])
        ->name('checkout')->middleware('auth');

    Route::post('checkout', [CheckoutController::class, 'store']);

    Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
        ->name('front.2fa');

    Route::post('currency', [CurrencyConverterController::class, 'store'])
        ->name('currency.store');

    Route::get('about-us', function () {
        return view('front.about');
    })->name('about-us');

    Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
    Route::post('contact-us', [ContactController::class, 'sendEmail'])->name('contact.send');

    Route::get('mail-success', function () {
        return view('front.mail-success');
    })->name('mail-success');

    Route::get('404', function () {
        return view('front.404');
    })->name('404');

    Route::get('faq', function () {
        return view('front.faq');
    })->name('faq');

    Route::get('mail-success', function () {
        return view('front.mail');
    })->name('mail-success');

    Route::resource('list-products', ListProductsController::class);
});

// Login with facebook and google
Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('auth.socilaite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('auth.socilaite.callback');

// Payment
Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
    ->name('orders.payments.create');
Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');
Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');
// Stripe webhook
Route::any('stripe/webhook', [StripeWebhooksController::class, 'handle']);

// Test delivery 
Route::get('/orders/{order}', [OrdersController::class, 'show'])
    ->name('orders.show');

// sms messages
Route::get('send-sms', [SendSms::class, 'send']);

// Working with images
Route::get('images/{disk}/{width}x{height}/{image}', [ImagesController::class, 'index'])
    ->name('image')
    ->where('image', '.*');

require __DIR__ . '/dashboard.php';