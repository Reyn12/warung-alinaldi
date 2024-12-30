<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function scanResult($code)
    {
        // Decode barcode
        // $decodedCode = urldecode($code);
        
        // Cari produk berdasarkan barcode
        $product = Product::where('barcode', $code)->first();
        
        // Jika produk tidak ditemukan
        if (!$product) {
            return view('products.not-found', [
                'barcode' => $code
            ]);
        }
        
        return view('products.scan-result', [
            'product' => $product
        ]);
    }

    public function manualSearch(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        
        // Get all categories for the dropdown
        $categories = Category::all();
        
        $products = Product::query()
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->get();
            
        return view('products.manual-search', [
            'products' => $products,
            'categories' => $categories,
            'query' => $query,
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'barcode' => 'required|string|unique:products,barcode',
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products/' . date('Y/m'), 'public');
            }

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'barcode' => $request->barcode,
                'category_id' => $request->category_id,
                'image' => $imagePath ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data' => $product
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
