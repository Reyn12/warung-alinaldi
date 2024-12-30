<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function scanResult($code)
    {
        // Decode barcode
        $decodedCode = urldecode($code);
        
        // Cari produk berdasarkan barcode
        $product = Product::where('barcode', $decodedCode)->first();
        
        // Jika produk tidak ditemukan
        if (!$product) {
            return view('products.not-found', [
                'barcode' => $decodedCode
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
        
        $products = Product::query()
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%");
            })
            ->when($category, function($q) use ($category) {
                return $q->where('category', $category);
            })
            ->get();
            
        return view('products.manual-search', [
            'products' => $products,
            'query' => $query,
            'category' => $category
        ]);
    }
}
