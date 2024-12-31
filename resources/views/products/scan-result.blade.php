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

        <!-- Product Details -->
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Detail Produk</h1>
            
            <!-- Product Image -->
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
            
            <!-- Product Details -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Stok</span>
                    <span class="font-medium">{{ $product->stock }} pcs</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Kode Produk</span>
                    <span class="font-medium">{{ $product->barcode }}</span>
                </div>

                <div class="mt-6">
                    <span class="text-gray-600">Jumlah</span>
                    <div class="flex items-center justify-center gap-4 mt-2">
                        <button type="button" onclick="updateQuantity(-1)" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200">
                            <span class="text-xl">-</span>
                        </button>
                        <input type="number" id="quantity" value="1" class="w-16 text-center text-xl font-semibold" readonly>
                        <button type="button" onclick="updateQuantity(1)" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200">
                            <span class="text-xl">+</span>
                        </button>
                    </div>
                </div>

                <button type="button" onclick="addToCart()" class="w-full bg-blue-600 text-white font-bold py-4 rounded-lg hover:bg-blue-700 transition duration-200 mt-4">
                    + Keranjang
                </button>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 flex justify-between items-center">
            <a href="/" class="text-blue-600 font-semibold">Scan Lagi</a>
            <a href="{{ route('keranjang.index') }}" class="text-blue-600 font-semibold">Lihat Keranjang</a>
        </div>

        <script>
            function updateQuantity(change) {
                const quantityInput = document.getElementById('quantity');
                let newQuantity = parseInt(quantityInput.value) + change;
                const maxStock = {{ $product->stock }};
                
                if (newQuantity < 1) newQuantity = 1;
                if (newQuantity > maxStock) newQuantity = maxStock;
                
                quantityInput.value = newQuantity;
            }

            function addToCart() {
                const quantity = document.getElementById('quantity').value;
                const productId = '{{ $product->id }}';

                // Tambahkan animasi loading pada tombol
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = 'Menambahkan...';
                button.disabled = true;

                // Ubah URL ke HTTPS jika diperlukan
                const url = '{{ route('keranjang.add') }}'.replace('http:', 'https:');

                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: parseInt(quantity),
                        _token: '{{ csrf_token() }}'
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.success) {
                        // Tampilkan notifikasi sukses
                        const notification = document.createElement('div');
                        notification.className = 'fixed top-4 left-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg text-center z-50';
                        notification.textContent = 'Produk berhasil ditambahkan ke keranjang!';
                        document.body.appendChild(notification);

                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                    } else {
                        throw new Error(data.message || 'Gagal menambahkan produk ke keranjang');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorNotif = document.createElement('div');
                    errorNotif.className = 'fixed top-4 left-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg text-center z-50';
                    errorNotif.textContent = error.message || 'Terjadi kesalahan saat menambahkan ke keranjang';
                    document.body.appendChild(errorNotif);
                    setTimeout(() => {
                        errorNotif.remove();
                    }, 3000);
                })
                .finally(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            }
        </script>
    </div>
</body>
</html>