<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS Payment - Toko Alinaldi</title>
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
            <h1 class="text-xl font-bold text-white">Pembayaran QRIS</h1>
        </div>

        <!-- Payment Details -->
        <div class="bg-white rounded-xl p-4 shadow-md mb-4">
            <h2 class="text-lg font-bold mb-4">Detail Pembayaran</h2>
            
            <div class="space-y-4">
                <!-- Amount -->
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Pembayaran</span>
                    <span class="font-bold text-lg">Rp 50.000</span>
                </div>

                <!-- QRIS Code -->
                <div class="border-t pt-4">
                    <p class="text-center text-gray-600 mb-4">Scan QRIS code di bawah ini untuk melakukan pembayaran</p>
                    <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-2">QRIS Code:</p>
                            <p class="font-mono text-sm break-all">{{ $qrisCode }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <h3 class="font-bold mb-3">Cara Pembayaran:</h3>
            <ol class="list-decimal list-inside space-y-2 text-gray-600">
                <li>Buka aplikasi e-wallet atau m-banking Anda</li>
                <li>Pilih menu Scan QRIS</li>
                <li>Scan QR Code di atas</li>
                <li>Periksa detail pembayaran</li>
                <li>Masukkan PIN Anda</li>
                <li>Pembayaran selesai</li>
            </ol>
        </div>

        <!-- Action Button -->
        <button onclick="checkPaymentStatus()" class="w-full bg-blue-500 text-white py-3 rounded-xl mt-6 font-bold hover:bg-blue-600">
            Cek Status Pembayaran
        </button>
    </div>

    <script>
        function checkPaymentStatus() {
            // Show loading
            Swal.fire({
                title: 'Memeriksa Pembayaran',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate payment check (replace with actual API call)
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
