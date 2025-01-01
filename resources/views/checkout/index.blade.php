<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Warung Alinaldi</title>
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
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
            <h1 class="text-3xl font-bold">Checkout</h1>
        </div>

        @if(count($items) > 0)
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Daftar Item -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Daftar Belanja</h2>
                    @foreach($items as $id => $item)
                        <div class="flex justify-between items-center border-b py-4">
                            <div class="flex items-center space-x-4">
                                @if($item['image'])
                                    <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="w-16 h-16 object-cover rounded">
                                @endif
                                <div>
                                    <h3 class="font-semibold">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">{{ number_format($item['price'], 0, ',', '.') }} × {{ $item['quantity'] }}</p>
                                    <p class="font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-xl font-bold">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <!-- Form Checkout -->
                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 mb-2" for="name">Nama Pembeli</label>
                            <input type="text" id="name" name="name" required 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="phone">Nomor HP</label>
                            <input type="tel" id="phone" name="phone" required 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="payment_method">Metode Pembayaran</label>
                            <select id="payment_method" name="payment_method" required 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih metode pembayaran</option>
                                <option value="cash">Tunai</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <button type="submit" 
                            class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Proses Pembayaran
                        </button>
                    </form>
                </div>
            </div>
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
