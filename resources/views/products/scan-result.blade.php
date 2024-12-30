<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-[Lato]">
    <div class="max-w-md mx-auto px-4 py-6">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center text-white mb-6">
            <svg class="w-8 h-8 bg-white bg-opacity-20 rounded-full p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-xl ml-2">Detail Produk</span>
        </a>

        <!-- Product Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Product Image -->
            <div class="h-48 bg-gray-100">
                @if($product->image)
                    @if(str_starts_with($product->image, 'images/'))
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @endif
                @else
                    <div class="flex items-center justify-center h-full">
                        <span class="text-4xl">❓</span>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                <p class="text-3xl font-bold text-blue-500 mt-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <div class="mt-6 space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stok</span>
                        <span class="font-medium">{{ $product->stock }} pcs</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kode Produk</span>
                        <span class="font-medium">{{ $product->barcode }}</span>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <button class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg mt-6 hover:bg-blue-600 transition duration-200">
                    + Keranjang
                </button>
            </div>
        </div>
    </div>
</body>
</html>