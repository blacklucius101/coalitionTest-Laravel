<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Import the File facade
use Carbon\Carbon; // Import Carbon for date handling

class ProductController extends Controller
{
    public function create()
    {
        $products = $this->getProducts(); // Retrieve existing products to display
        return view('product.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Calculate total value
        $totalValue = $validatedData['quantity'] * $validatedData['price'];

        // Prepare data with datetime
        $data = [
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'datetime_submitted' => Carbon::now()->toDateTimeString(),
            'total_value' => $totalValue,
        ];

        // Save to JSON file
        $this->saveProductData($data);

        return redirect()->route('product.create')->with('success', 'Product saved successfully!');
    }

    private function saveProductData($data)
    {
        $filePath = storage_path('app/products.json');

        // Get existing products
        $products = $this->getProducts();

        // Add the new product
        $products[] = $data;

        // Save to JSON file
        File::put($filePath, json_encode($products, JSON_PRETTY_PRINT));
    }

    private function getProducts()
    {
        $filePath = storage_path('app/products.json');

        // Check if the file exists and read the data
        if (File::exists($filePath)) {
            $json = File::get($filePath);
            return json_decode($json, true);
        }

        return []; // Return empty array if file does not exist
    }
	
    public function edit($index)
    {
        $products = $this->getProducts();
        if (isset($products[$index])) {
            return view('product.edit', [
                'product' => $products[$index],
                'index' => $index
            ]);
        }
        
        return redirect()->route('product.create')->with('error', 'Product not found.');
    }

    public function update(Request $request, $index)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Calculate total value
        $totalValue = $validatedData['quantity'] * $validatedData['price'];

        // Prepare updated data with datetime
        $data = [
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'datetime_submitted' => Carbon::now()->toDateTimeString(),
            'total_value' => $totalValue,
        ];

        // Get existing products
        $products = $this->getProducts();

        // Update the specific product
        if (isset($products[$index])) {
            $products[$index] = $data;

            // Save updated products to JSON file
            File::put(storage_path('app/products.json'), json_encode($products, JSON_PRETTY_PRINT));
        }

        return redirect()->route('product.create')->with('success', 'Product updated successfully!');
    }
}
