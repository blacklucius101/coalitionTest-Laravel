<!-- resources/views/product/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create a New Product</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
                @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Quantity in Stock:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price per Item:</label>
                <input type="text" class="form-control" id="price" name="price" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="mt-5">Submitted Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity in Stock</th>
                    <th>Price per Item</th>
                    <th>Datetime Submitted</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalSum = 0;
                @endphp
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ number_format($product['price'], 2) }}</td>
                        <td>{{ $product['datetime_submitted'] }}</td>
                        <td>{{ number_format($product['total_value'], 2) }}</td>
                    </tr>
                    @php
                        $totalSum += $product['total_value'];
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4"><strong>Total Sum</strong></td>
                    <td><strong>{{ number_format($totalSum, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
