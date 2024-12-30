<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Toko Alinaldi</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'lato': ['Lato', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-lato">
    <div class="max-w-md mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/icons/icProfile.svg') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                <div>
                    <p class="text-white">Selamat Datang,</p>
                    <p class="text-white font-semibold">Toko Alinaldi</p>
                </div>
            </div>
            <div class="bg-white p-2 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-6">
            <input type="text" placeholder="Cari barang disini ...." class="w-full py-3 px-4 pr-12 rounded-full bg-white/80 backdrop-blur-sm shadow-md">
            <button class="absolute right-3 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <!-- Quick Actions -->
        <div class="flex gap-4 mb-6">
            <button class="flex-1 flex items-center justify-center gap-2 bg-white p-4 rounded-xl shadow-lg h-20">
                <img src="{{ asset('images/icons/icProduk.svg') }}" alt="List Produk" class="w-8 h-8">
                <span class="font-bold">List Produk</span>
            </button>
            <button class="flex-1 flex items-center justify-center gap-2 bg-white p-4 rounded-xl shadow-lg h-20">
                <img src="{{ asset('images/icons/icQris.svg') }}" alt="Scan QRIS" class="w-8 h-8">
                <span class="font-bold">Scan QRIS</span>
            </button>
        </div>

        <!-- Categories Header -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2">
                <span>📸</span>
                <span class="font-medium">Kategori</span>
            </div>
            <a href="#" class="text-sm text-gray-600">Lihat Semua</a>
        </div>

        <!-- Categories Flex -->
        <div class="flex flex-wrap gap-3">
            <!-- Bahan Pokok -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🍚</span>
                        <div>
                            <p class="font-bold text-base mb-1">Bahan Pokok</p>
                            <p class="text-sm text-gray-500">15 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Bumbu Dapur -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🧂</span>
                        <div>
                            <p class="font-bold text-sm mb-1">Bumbu Dapur</p>
                            <p class="text-sm text-gray-500">22 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Minuman -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🥤</span>
                        <div>
                            <p class="font-bold text-base mb-1">Minuman</p>
                            <p class="text-sm text-gray-500">10 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Makanan Ringan -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🍪</span>
                        <div>
                            <p class="font-bold text-sm mb-1">Mknan Ringan</p>
                            <p class="text-sm text-gray-500">26 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Mie Instant -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🍜</span>
                        <div>
                            <p class="font-bold text-base mb-1">Mie Instant</p>
                            <p class="text-sm text-gray-500">22 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Peralatan Mandi -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🧴</span>
                        <div>
                            <p class="font-bold text-base mb-1">Alat Mandi</p>
                            <p class="text-sm text-gray-500">9 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Deterjen & Baju -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🧺</span>
                        <div>
                            <p class="font-bold text-base mb-1">Dtrjen & Baju</p>
                            <p class="text-sm text-gray-500">13 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <!-- Rokok -->
            <div class="w-[calc(50%-6px)] bg-white p-4 rounded-xl shadow-md">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="text-2xl">🚬</span>
                        <div>
                            <p class="font-bold text-base mb-1">Rokok</p>
                            <p class="text-sm text-gray-500">28 Produk Tersedia</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</body>
</html>