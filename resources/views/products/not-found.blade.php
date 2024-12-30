<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Tidak Ditemukan - Toko Alinaldi</title>
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
            <h1 class="text-xl font-bold text-white">Produk Tidak Ditemukan</h1>
        </div>

        <!-- Not Found Message -->
        <div class="bg-white rounded-xl p-6 text-center shadow-md">
            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            <h2 class="text-xl font-bold mb-2">Produk Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-4">Maaf, produk dengan barcode berikut tidak ditemukan:</p>
            <p class="font-mono bg-gray-100 p-2 rounded mb-6">{{ $barcode }}</p>

            <div class="space-y-3">
                <button onclick="window.location.href='/products/search'" class="w-full bg-blue-500 text-white py-3 rounded-xl font-bold hover:bg-blue-600">
                    Cari Manual
                </button>
                <button onclick="window.history.back()" class="w-full border border-gray-300 text-gray-600 py-3 rounded-xl font-bold hover:bg-gray-50">
                    Scan Ulang
                </button>
            </div>
        </div>
    </div>
</body>
</html>
