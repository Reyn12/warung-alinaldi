<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total = 0;
        
        // Debug: Log isi keranjang
        Log::info('Isi Keranjang:', $keranjang);
        
        // Pastikan setiap item memiliki ID
        $keranjang = collect($keranjang)->map(function($item, $key) {
            if (!isset($item['id'])) {
                $item['id'] = $key;
            }
            return $item;
        })->toArray();
        
        foreach ($keranjang as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('keranjang.index', [
            'items' => $keranjang,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        try {
            $data = $request->json()->all();
            $product = Product::find($data['product_id']);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            // Validasi stok
            if ($product->stock < $data['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi'
                ], 400);
            }

            $keranjang = session()->get('keranjang', []);
            $productId = (string)$product->id; // Konversi ke string untuk konsistensi
            
            // Jika produk sudah ada di keranjang, update quantity
            if(isset($keranjang[$productId])) {
                $newQuantity = $keranjang[$productId]['quantity'] + $data['quantity'];
                
                // Cek stok lagi untuk total quantity
                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Total quantity melebihi stok yang tersedia'
                    ], 400);
                }
                
                $keranjang[$productId]['quantity'] = $newQuantity;
            } else {
                // Jika belum ada, tambahkan produk baru
                $keranjang[$productId] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'quantity' => (int)$data['quantity'],
                    'price' => $product->price,
                    'image' => $product->image
                ];
            }
            
            session()->put('keranjang', $keranjang);
            
            Log::info('Item ditambahkan ke keranjang:', [
                'product_id' => $productId,
                'keranjang' => $keranjang
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'cart_count' => count($keranjang)
            ]);
        } catch (\Exception $e) {
            Log::error('Error in KeranjangController@add: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('keranjang', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('keranjang', $cart);
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Item tidak ditemukan'
        ]);
    }

    public function clear(Request $request)
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function update(Request $request)
    {
        try {
            $cart = session()->get('keranjang', []);
            $data = $request->json()->all();
            $id = $data['id'];
            $change = $data['change'];

            if (isset($cart[$id])) {
                $newQuantity = $cart[$id]['quantity'] + $change;
                
                // Pastikan quantity tidak kurang dari 1
                if ($newQuantity < 1) {
                    $newQuantity = 1;
                }
                
                $cart[$id]['quantity'] = $newQuantity;
                session()->put('keranjang', $cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Quantity berhasil diupdate'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
