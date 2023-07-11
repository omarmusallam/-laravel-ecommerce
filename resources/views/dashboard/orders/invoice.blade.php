<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        h2 {
            color: blue;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">{{ config('app.name') }}</h2>
    <table class="table" border="1">
        <tr>
            <td>Order Number</td>
            <td style="text-align: center">#{{ $order->number }}</td>
            <td>Order Date</td>
            <td style="text-align: center">{{ $order->created_at->toDateString() }}</td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td style="text-align: center">{{ $order->user->name }}</td>
            <td>Payment Status</td>
            <td style="text-align: center">{{ $order->payment->status }}</td>
        </tr>
    </table>
    <h3>Order Details</h3>
    <table class="table" border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr style="text-align: center">
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Thank you for order.</p>
</body>

</html>
