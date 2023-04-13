@extends('layouts.dashboard')
@section('title', ' Order Number: ' . $order->number)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
    <li class="breadcrumb-item active">{{ $order->number }}</li>

@endsection
@section('content')
    <h4 style="font-family: 'Times New Roman', Times, serif">Address Details:</h4>
    <table class="table" border="1" style="border: 2px solid black;">
        <thead>
            <tr style="background-color: #817d7d; text-align: center">
                <th>Address</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>street</th>
                <th>city</th>
                <th>postal_code</th>
                <th>state</th>
                <th>country</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center">
                <td>Billing</td>
                <td>{{ $order->billingAddress->name }}</td>
                <td>{{ $order->billingAddress->email }}</td>
                <td>{{ $order->billingAddress->phone_number }}</td>
                <td>{{ $order->billingAddress->street_address }}</td>
                <td>{{ $order->billingAddress->city }}</td>
                <td>{{ $order->billingAddress->postal_code }}</td>
                <td>{{ $order->billingAddress->state }}</td>
                <td>{{ $order->billingAddress->country }}</td>
            </tr>
            <tr style="text-align: center">
                <td>Shipping</td>
                <td>{{ $order->shippingAddress->name }}</td>
                <td>{{ $order->shippingAddress->email }}</td>
                <td>{{ $order->shippingAddress->phone_number }}</td>
                <td>{{ $order->shippingAddress->street_address }}</td>
                <td>{{ $order->shippingAddress->city }}</td>
                <td>{{ $order->shippingAddress->postal_code }}</td>
                <td>{{ $order->shippingAddress->state }}</td>
                <td>{{ $order->shippingAddress->country }}</td>
            </tr>
        </tbody>
    </table>
    <h4 style="font-family: 'Times New Roman', Times, serif">Product Details:</h4>
    <table class="table" border="1" style="border: 2px solid black;">
        <thead>
            <tr style="background-color: #817d7d; text-align: center">
                {{-- <th>Product-Items</th> --}}
                <th>Product_Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total-Price</th>
            </tr>
        </thead>
        <tbody>
            @if ($order->items->count())
                @foreach ($order->items as $product)
                    <tr style="text-align: center">
                        {{-- <td></td> --}}
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $order->payment->amount }}</td>
                @endforeach
                </tr>
            @endif

        </tbody>
    </table>
@endsection
