@extends('layouts.dashboard')
@section('title', 'Orders')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection
@section('content')
    {{-- <div class="mb-5">
        @if (Auth::user()->can('orders.create'))
        <a href="{{ route('dashboard.orders.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endif
        <a href="{{ route('dashboard.orders.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a>
    </div> --}}

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="number of order" class="mx-2" :value="request('name')" />
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <h4 style="font-family: 'Times New Roman', Times, serif">Orders Details:</h4>
    <table class="table" border = "1" style="border: 2px solid black;">
        <thead>
            <tr style="background-color: #817d7d; text-align: center">
                <th>ID</th>
                <th>Number</th>
                <th>Store</th>
                <th>User</th>
                <th>Payment</th>
                {{-- <th>Currency</th> --}}
                <th>Total-Price</th>
                <th>Payment-Status</th>
                <th>Created At</th>
                <th colspan="3">Processing</th>
            </tr>
        </thead>
        <tbody>
            @if ($orders->count())
                @foreach ($orders as $order)
                    <tr style="text-align: center">
                        <td>{{ $order->id }}</td>
                        <td><a href="{{ route('dashboard.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                        <td>{{ $order->store->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->payment->method }}</td>
                        {{-- <td>{{ $order->payment->currency }}</td> --}}
                        <td>{{ $order->payment->amount }}</td>
                        <td>{{ $order->payment->status }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.orders.print', $order->id) }}"
                                class="btn btn-sm btn-outline-info">Print</a>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                class="btn btn-sm btn-outline-success">Show</a>
                        </td>
                        <td>
                            @can('orders.delete')
                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">No Orders defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $orders->withQueryString()->appends(['search' => 1])->links() }}
@endsection
