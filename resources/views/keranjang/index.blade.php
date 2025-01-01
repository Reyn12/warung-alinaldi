<!DOCTYPE html>
@php
use Illuminate\Support\Str;
@endphp
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang - Warung Alinaldi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-blue-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center mb-6">
            <a href="{{ url()->previous() }}" class="text-3xl text-blue-500 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold">Keranjang</h1>
            <a href="/" class="ml-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-barcode mr-2"></i>
                Tambah Barang
            </a>
        </div>

        @if(session()->has('keranjang') && count(session('keranjang')) > 0)
            <div class="bg-white rounded-lg shadow p-6">
                @foreach(session('keranjang') as $id => $item)
                    <div class="flex items-center justify-between border-b py-4">
                        <div class="flex items-center space-x-4">
                            @if($item['image'])
                                @if(Str::startsWith($item['image'], 'products/'))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                @endif
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                                <p class="text-gray-600">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="updateCart({{ $id }}, -1)" class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300">
                                    <i class="fas fa-minus text-gray-600"></i>
                                </button>
                                <span class="w-8 text-center font-medium">{{ $item['quantity'] }}</span>
                                <button onclick="updateCart({{ $id }}, 1)" class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300">
                                    <i class="fas fa-plus text-gray-600"></i>
                                </button>
                            </div>
                            <button onclick="removeFromCart({{ $id }})" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach

                <div class="mt-6 border-t pt-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold">Total</span>
                        <span class="text-xl font-bold">Rp {{ number_format(collect(session('keranjang'))->sum(function($item) { 
                            return $item['price'] * $item['quantity'];
                        }), 0, ',', '.') }}</span>
                    </div>

                    <div class="space-y-3">
                        <button onclick="clearCart()" class="w-full py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Kosongkan Keranjang
                        </button>
                        <a href="{{ route('checkout.index') }}" class="block w-full py-3 bg-blue-500 text-white text-center rounded-lg hover:bg-blue-600 transition">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                const baseUrl = window.location.origin;

                function updateCart(id, change) {
                    axios.post(`${baseUrl}/keranjang/update`, {
                        id: id,
                        change: change
                    })
                    .then(function (response) {
                        if (response.data.success) {
                            location.reload();
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
                }

                function removeFromCart(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                        fetch(`${baseUrl}/keranjang/remove`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                    }
                }

                function clearCart() {
                    if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                        window.location.href = `${baseUrl}/keranjang/clear`;
                    }
                }
            </script>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500 text-lg">Keranjang belanja Anda kosong</p>
                <a href="{{ route('homepage') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</body>
</html>
