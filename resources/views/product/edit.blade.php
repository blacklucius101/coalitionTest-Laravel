<!-- resources/views/product/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Product</h1>

        <form action="{{ route('product.update', $index) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product['product_name'] }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity in Stock:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product['quantity'] }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price per Item:</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product['price'] }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
