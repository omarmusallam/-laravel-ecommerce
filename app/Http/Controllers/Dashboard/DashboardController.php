<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Notification as ModelsNotification;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth'])->only('index');
    }

    // Actions
    public function index()
    {
        $title = 'Store';
        $user = Auth::user();

        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalProduct = Product::count();
        $totalCategory = Category::count();

        $totalUser = User::count();
        $totalAdmin = Admin::count();

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        return view('dashboard.index', [
            'user' => 'Omar',
            'title' => $title,
            'totalProduct' => $totalProduct,
            'totalCategory' => $totalCategory,
            'totalUser' => $totalUser,
            'totalAdmin' => $totalAdmin,
            'totalOrder' => $totalOrder,
            'todayOrder' => $todayOrder,
            'thisMonthOrder' => $thisMonthOrder,
            'thisYearOrder' => $thisYearOrder,
        ]);
    }

    public function notify()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(3);
        $newCount = $user->unreadNotifications()->count();

        return view('dashboard.notification', compact('notifications', 'newCount'));
    }
    public function markAsRead()
    {
        $user = Auth::user();
        $user = Admin::find($user->id);
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}