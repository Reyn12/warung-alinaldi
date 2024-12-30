<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        .cart-summary {
            position: fixed;
            bottom: 10px;
            left: 10px;
            right: 10px;
            background: white;
            padding: 1rem;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1),
                        0 -2px 4px -2px rgba(0, 0, 0, 0.05),
                        0 4px 6px -1px rgba(0, 0, 0, 0.1); /* Shadow atas */
            transform: translateY(100%);
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        .cart-summary.show {
            transform: translateY(0);
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #6B21A8;
            color: white;
            border-radius: 999px;
            padding: 2px 8px;
            font-size: 12px;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-[Lato]">
    <div class="max-w-md mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ url('/') }}" class="p-2 rounded-full bg-white/20 hover:bg-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-white ml-2">Cari Produk</h1>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-xl p-4 shadow-md mb-6">
            <div class="space-y-4">
                <!-- Search Input -->
                <div>
                    <label class="block text-gray-600 mb-2">Nama Produk</label>
                    <input type="text" 
                        id="searchInput"
                        name="query"
                        value="{{ request('query') }}"
                        class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Indomie Goreng">
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-gray-600 mb-2">Kategori</label>
                    <select id="categorySelect" name="category" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div id="searchResults" class="space-y-4">
            @if(isset($products) && count($products) > 0)
                @foreach($products as $product)
                    <div class="bg-white p-4 rounded-xl shadow-md">
                        <div class="flex items-center gap-4">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500">Stok: {{ $product->stock }} pcs</p>
                            </div>
                            <div>
                                <button onclick="showQuantityControls(this, {{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    + Tambah
                                </button>
                                <div class="quantity-controls hidden">
                                    <div class="flex items-center gap-3 bg-gray-100 rounded-full p-2">
                                        <button onclick="updateQuantity({{ $product->id }}, -1)" class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-50">-</button>
                                        <input type="number" id="quantity-{{ $product->id }}" value="1" min="1" max="{{ $product->stock }}" 
                                            class="w-12 text-center bg-transparent"
                                            onchange="validateQuantity(this, {{ $product->stock }}, {{ $product->id }})">
                                        <button onclick="updateQuantity({{ $product->id }}, 1)" class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-50">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Cart Summary -->
    <div id="cartSummary" class="cart-summary rounded-3xl shadow-lg p-5">
        <div class="max-w-md mx-auto flex items-center justify-between">
            <div>
                <p class="text-gray-600">Total Harga</p>
                <p class="text-xl font-bold" id="totalPrice">Rp0</p>
            </div>
            <button onclick="viewCart()" class="px-6 py-2 bg-blue-500 text-white rounded-lg font-bold hover:bg-blue-600 relative">
                Lihat Pesanan
                <span id="cartBadge" class="cart-badge hidden">0</span>
            </button>
        </div>
    </div>

    <script>
        let cart = [];
        let totalPrice = 0;
        let searchTimeout;
        
        // Live search
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 300);
        });

        document.getElementById('categorySelect').addEventListener('change', performSearch);

        function performSearch() {
            const query = document.getElementById('searchInput').value;
            const category = document.getElementById('categorySelect').value;
            
            fetch(`/products/search?query=${encodeURIComponent(query)}&category=${encodeURIComponent(category)}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const results = doc.getElementById('searchResults');
                    document.getElementById('searchResults').innerHTML = results.innerHTML;
                    
                    // Restore quantity controls state
                    cart.forEach(item => {
                        const addButton = document.querySelector(`button[onclick*="showQuantityControls(this, ${item.id}"]`);
                        if (addButton) {
                            const controls = addButton.nextElementSibling;
                            const input = controls.querySelector('input');
                            
                            // Hide add button, show controls
                            addButton.classList.add('hidden');
                            controls.classList.remove('hidden');
                            
                            // Set quantity
                            input.value = item.quantity;
                        }
                    });
                });
        }

        function showQuantityControls(button, productId, productName, productPrice) {
            const controls = button.nextElementSibling;
            button.classList.add('hidden');
            controls.classList.remove('hidden');
            
            // Add to cart
            addToCart(productId, productName, productPrice, 1);
        }

        function updateQuantity(productId, change) {
            const input = document.getElementById(`quantity-${productId}`);
            let newValue = parseInt(input.value) + change;
            
            // Jika quantity 0 atau kurang, hapus dari keranjang
            if (newValue <= 0) {
                removeFromCart(productId);
                // Tampilkan kembali tombol Tambah
                const quantityControls = input.closest('.quantity-controls');
                const addButton = quantityControls.previousElementSibling;
                quantityControls.classList.add('hidden');
                addButton.classList.remove('hidden');
                return;
            }
            
            // Validate max
            const maxStock = parseInt(input.getAttribute('max'));
            if (newValue > maxStock) newValue = maxStock;
            
            // Update input value
            input.value = newValue;
            
            // Update cart
            updateCart(productId, newValue);
        }

        function validateQuantity(input, maxStock, productId) {
            let value = parseInt(input.value);
            if (isNaN(value) || value < 0) value = 0;
            if (value > maxStock) value = maxStock;
            input.value = value;
            
            // Jika quantity 0, hapus dari keranjang
            if (value === 0) {
                removeFromCart(productId);
                // Tampilkan kembali tombol Tambah
                const quantityControls = input.closest('.quantity-controls');
                const addButton = quantityControls.previousElementSibling;
                quantityControls.classList.add('hidden');
                addButton.classList.remove('hidden');
                return;
            }
            
            // Update cart when manually typing
            updateCart(productId, value);
        }

        function addToCart(productId, name, price, quantity) {
            const index = cart.findIndex(item => item.id === productId);
            
            if (index === -1) {
                cart.push({
                    id: productId,
                    name: name,
                    price: price,
                    quantity: quantity
                });
            } else {
                cart[index].quantity = quantity;
            }
            
            updateCartSummary();
        }

        function removeFromCart(productId) {
            const index = cart.findIndex(item => item.id === productId);
            if (index !== -1) {
                cart.splice(index, 1);
                updateCartSummary();
            }
        }

        function updateCart(productId, quantity) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity = quantity;
                updateCartSummary();
            }
        }

        function updateCartSummary() {
            totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            // Update UI
            document.getElementById('totalPrice').textContent = `Rp${totalPrice.toLocaleString()}`;
            const badge = document.getElementById('cartBadge');
            badge.textContent = totalItems;
            badge.classList.toggle('hidden', totalItems === 0);
            
            // Show/hide cart summary
            const cartSummary = document.getElementById('cartSummary');
            if (cart.length === 0) {
                cartSummary.classList.remove('show');
            } else {
                cartSummary.classList.add('show');
            }
        }

        function viewCart() {
            // Implement view cart functionality
            console.log('Cart items:', cart);
        }
    </script>
</body>
</html>
