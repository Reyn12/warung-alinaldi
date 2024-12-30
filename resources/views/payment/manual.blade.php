<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Manual - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1 class="text-xl font-bold text-white">Input Manual</h1>
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <h2 class="text-lg font-bold mb-4">Detail Pembayaran</h2>
            
            <form onsubmit="handleSubmit(event)" class="space-y-4">
                <!-- Amount -->
                <div>
                    <label class="block text-gray-600 mb-2">Total Pembayaran</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" 
                            class="w-full pl-12 pr-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="0"
                            required>
                    </div>
                </div>

                <!-- Payment Method -->
                <div>
                    <label class="block text-gray-600 mb-2">Metode Pembayaran</label>
                    <select class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih metode pembayaran</option>
                        <option value="gopay">GoPay</option>
                        <option value="ovo">OVO</option>
                        <option value="dana">DANA</option>
                        <option value="shopeepay">ShopeePay</option>
                        <option value="linkaja">LinkAja</option>
                    </select>
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-gray-600 mb-2">Nomor Telepon</label>
                    <input type="tel" 
                        class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: 08123456789"
                        pattern="[0-9]{10,13}"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-xl font-bold hover:bg-blue-600">
                    Proses Pembayaran
                </button>
            </form>
        </div>

        <!-- Instructions -->
        <div class="bg-white rounded-xl p-4 shadow-md mt-4">
            <h3 class="font-bold mb-3">Catatan:</h3>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                <li>Pastikan nomor telepon yang dimasukkan aktif</li>
                <li>Pembayaran akan diproses sesuai metode yang dipilih</li>
                <li>Anda akan menerima notifikasi pembayaran</li>
            </ul>
        </div>
    </div>

    <script>
        function handleSubmit(event) {
            event.preventDefault();

            // Show loading
            Swal.fire({
                title: 'Memproses Pembayaran',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate payment processing (replace with actual API call)
            setTimeout(() => {
                Swal.fire({
                    title: 'Pembayaran Berhasil!',
                    text: 'Terima kasih telah berbelanja di Toko Alinaldi',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/';
                    }
                });
            }, 2000);
        }
    </script>
</body>
</html>
