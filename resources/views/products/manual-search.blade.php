<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk - Toko Alinaldi</title>
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
            <h1 class="text-xl font-bold text-white">Cari Produk</h1>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <form onsubmit="handleSearch(event)" class="space-y-4">
                <!-- Search Input -->
                <div>
                    <label class="block text-gray-600 mb-2">Nama Produk</label>
                    <input type="text" 
                        class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Indomie Goreng"
                        required>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-gray-600 mb-2">Kategori</label>
                    <select class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="mie">Mie Instant</option>
                        <option value="minuman">Minuman</option>
                        <option value="snack">Makanan Ringan</option>
                        <option value="pokok">Bahan Pokok</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg font-bold hover:bg-blue-600">
                    Cari Produk
                </button>
            </form>
        </div>

        <!-- Search Results -->
        <div id="searchResults" class="mt-4 space-y-3 hidden">
            <!-- Result items will be inserted here -->
        </div>
    </div>

    <script>
        function handleSearch(event) {
            event.preventDefault();
            
            // Show loading state
            const results = document.getElementById('searchResults');
            results.innerHTML = `
                <div class="bg-white rounded-xl p-4 shadow-md animate-pulse">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                        </div>
                    </div>
                </div>
            `;
            results.classList.remove('hidden');

            // Simulate API call (replace with actual search)
            setTimeout(() => {
                // Example search results
                results.innerHTML = `
                    <div class="bg-white rounded-xl p-4 shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-100 rounded">
                                <img src="https://example.com/indomie.jpg" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold">Indomie Goreng</h3>
                                <p class="text-blue-500 font-bold">Rp 3.500</p>
                                <p class="text-sm text-gray-500">Stok: 50 pcs</p>
                            </div>
                        </div>
                    </div>
                `;
            }, 1000);
        }
    </script>
</body>
</html>
