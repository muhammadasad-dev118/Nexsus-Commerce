<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-6">
    <h1 class="text-2xl font-bold mb-4">Invoice #{{ $order->order_number }}</h1>
    <p>Customer: {{ $order->customer->name }}</p>
    <p>Email: {{ $order->customer->email }}</p>
    <p>Status: {{ $order->status }}</p>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Product</th>
                <th class="p-2 text-left">Variant</th>
                <th class="p-2 text-left">Qty</th>
                <th class="p-2 text-left">Price</th>
                <th class="p-2 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr class="border-b">
                <td class="p-2">{{ $item->product_name }}</td>
                <td class="p-2">{{ json_encode($item->variant_attributes) }}</td>
                <td class="p-2">{{ $item->quantity }}</td>
                <td class="p-2">${{ number_format($item->price, 2) }}</td>
                <td class="p-2">${{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-4 font-bold">Total: ${{ number_format($order->total_amount, 2) }}</p>

    <button onclick="window.print()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Print Invoice</button>
</body>
</html>