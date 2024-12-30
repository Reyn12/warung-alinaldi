<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-[Lato]">
    <div class="max-w-md mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <button onclick="window.history.back()" class="p-2 rounded-full bg-white/20 hover:bg-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-xl font-bold text-white">Detail Produk</h1>
        </div>

        <!-- Product Details -->
        <div class="bg-white rounded-xl overflow-hidden shadow-md">
            <!-- Product Image -->
            <div class="aspect-square bg-gray-100">
                <img src="{{ asset($product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Product Info -->
            <div class="p-4 space-y-4">
                <div>
                    <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                    <p class="text-2xl font-bold text-blue-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stok</span>
                        <span class="font-semibold">{{ $product->stock }} pcs</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kode Produk</span>
                        <span class="font-mono">{{ $product->barcode }}</span>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <button onclick="addToCart()" class="w-full bg-blue-500 text-white py-3 rounded-lg font-bold hover:bg-blue-600">
                    + Keranjang
                </button>
            </div>
        </div>
    </div>

    <script>
        function addToCart() {
            // TODO: Implement add to cart functionality
            alert('Produk ditambahkan ke keranjang!');
        }
    </script>
</body>
</html>
