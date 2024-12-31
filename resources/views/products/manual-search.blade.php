<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cari Produk - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-[Lato]">
    <div class="max-w-md mx-auto px-4 py-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="/" class="p-2 rounded-full bg-white/20 hover:bg-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-white">Cari Produk</h1>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-xl p-4 shadow-md mb-6">
            <form action="{{ route('products.search') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="query" value="{{ $query ?? '' }}" 
                           placeholder="Contoh: Indomie Goreng"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700">
                    Cari Produk
                </button>
            </form>
        </div>

        <!-- Product Cards -->
        <div class="grid grid-cols-2 gap-4 mb-24">
            @forelse ($products as $product)
                <div class="bg-white p-4 rounded-xl shadow-md">
                    <h3 class="font-bold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600">Stok: {{ $product->stock }}</p>
                    <p class="font-bold text-purple-800 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <button onclick="addToCart(event, {{ $product->id }})" 
                            class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-200">
                        + Keranjang
                    </button>
                </div>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-500">
                    Tidak ada produk ditemukan
                </div>
            @endforelse
        </div>
    </div>

    <script>
    function addToCart(event, productId) {
        event.preventDefault();
        
        // Buat form untuk submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('keranjang.add') }}';
        
        // Tambahkan CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Tambahkan product_id
        const productInput = document.createElement('input');
        productInput.type = 'hidden';
        productInput.name = 'product_id';
        productInput.value = productId;
        form.appendChild(productInput);
        
        // Tambahkan quantity
        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = '1';
        form.appendChild(quantityInput);
        
        // Tambahkan form ke document dan submit
        document.body.appendChild(form);
        form.submit();
    }
    </script>
</body>
</html>
