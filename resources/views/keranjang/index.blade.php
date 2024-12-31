<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-sky-400 to-white min-h-screen font-[Lato]">
    <div class="max-w-md mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="/" class="p-2 rounded-full bg-white/20 hover:bg-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-white">Keranjang</h1>
        </div>

        <!-- Cart Items -->
        <div class="bg-white rounded-xl overflow-hidden shadow-md">
            @if(count($items) > 0)
                <div class="divide-y">
                    @foreach($items as $item)
                        <div class="p-4 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                <form action="{{ route('keranjang.remove', $item['id']) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus item ini?')" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="p-4 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="p-4 space-y-2">
                    <form action="{{ route('keranjang.clear') }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Yakin ingin mengosongkan keranjang?')" class="w-full py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Kosongkan Keranjang
                        </button>
                    </form>
                    <a href="/checkout" class="block w-full py-2 bg-blue-500 text-white text-center rounded-lg hover:bg-blue-600 transition-colors">
                        Checkout
                    </a>
                </div>
            @else
                <div class="p-8 text-center">
                    <p class="text-gray-500">Keranjang masih kosong</p>
                    <a href="/" class="mt-4 inline-block text-blue-500 hover:text-blue-600">Mulai Belanja</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
