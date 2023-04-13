<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function index()
    {
        if (!Gate::allows('orders.view')) {
            abort(403);
        }
        $request = request();
        $orders = Order::with(['store', 'payment', 'items'])
            ->filter($request->query())
            ->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (!Gate::allows('orders.view')) {
            abort(403);
        }

        return view('dashboard.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);
        $order->delete();

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Deleted Done!');
    }

}