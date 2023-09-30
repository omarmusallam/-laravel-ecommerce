<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdersController extends Controller
{
    public function print(Order $order)
    {
        return view('dashboard.orders.invoice', compact('order'));
    }

    public function index()
    {
        if (!Gate::allows('orders.view')) {
            abort(403);
        }
        $request = request();
        $orders = Order::with(['store', 'payment', 'items'])
            ->filter($request->query())
            ->orderBy('orders.created_at', 'desc')
            ->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show($id)
    {
        if (!Gate::allows('orders.show')) {
            abort(403);
        }
        $order = Order::findOrFail($id);

        $notificationId = DB::table('notifications')->where('data->order_id', $id)->pluck('id')->first();
        if ($notificationId) {
            Notification::find($notificationId)->update(['read_at' => now()]);
        }

        return view('dashboard.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if (!Gate::allows('orders.delete')) {
            abort(403);
        }
        $order->delete();

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Deleted Done!');
    }
}
