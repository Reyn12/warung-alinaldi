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
                    }
                }
            }
        }
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- HTML5 QR Code Scanner -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        /* Fix untuk Android */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 0 1px;
        }

        .category-item {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        /* Fix untuk modal di Android & iOS */
        .swal2-popup {
            padding: 0 !important;
            width: 92% !important;
            max-width: 92% !important;
            margin: 0 auto !important;
            position: fixed !important;
            bottom: 0 !important;
            top: auto !important;
            left: 4% !important;
            right: 4% !important;
            border-radius: 16px 16px 0 0 !important;
        }

        .swal2-modal {
            margin: 0 !important;
            border-radius: 16px 16px 0 0 !important;
        }

        .swal2-title {
            padding: 16px !important;
            font-size: 18px !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
            text-align: center !important;
            border-bottom: 1px solid #e5e7eb !important;
            margin: 0 !important;
        }

        .scanner-container {
            padding: 16px;
            background: white;
        }

        #reader {
            width: 100% !important;
            border: none !important;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            background: #f3f4f6;
            margin: 0 auto;
        }

        #reader video {
            object-fit: cover !important;
        }

        /* Fix untuk button group */
        .button-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            padding: 16px;
            background: white;
        }

        .scan-button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        /* Fix untuk close button */
        .swal2-close {
            position: absolute !important;
            right: 16px !important;
            top: 16px !important;
            width: 24px !important;
            height: 24px !important;
            color: #6b7280 !important;
            font-size: 24px !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
            border: none !important;
            opacity: 0.7 !important;
        }

        .swal2-close:hover {
            color: #374151 !important;
            opacity: 1 !important;
        }
    </style>
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
                <img src="{{ asset('images/icons/icKeranjang.svg') }}" alt="Cart" class="w-6 h-6">
            </div>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-6">
            <input type="text" placeholder="Cari barang disini ...." class="w-full py-3 px-6 rounded-full bg-white/80 backdrop-blur-sm shadow-md">
            <button class="absolute right-3 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 gap-3 mb-6">
            <div class="bg-white rounded-xl p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50 transition-colors shadow-md">
                <img src="{{ asset('images/icons/icProduk.svg') }}" alt="List" class="w-6 h-6 mr-2">
                <span class="font-semibold">List Produk</span>
            </div>
            <div onclick="showQrisModal()" class="bg-white rounded-xl p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50 transition-colors shadow-md">
                <img src="{{ asset('images/icons/icQris.svg') }}" alt="Scan" class="w-6 h-6 mr-2">
                <span class="font-semibold">Scan Barcode</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="mb-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">
                    <span class="mr-2">📸</span>
                    Kategori
                </h2>
                <a href="#" class="text-gray-600">Lihat Semua</a>
            </div>

            <div class="category-grid">
                <!-- Bahan Pokok -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🍚</span>
                            <div>
                                <h3 class="font-semibold">Bahan Pokok</h3>
                                <p class="text-sm text-gray-500">15 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Bumbu Dapur -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🧂</span>
                            <div>
                                <h3 class="font-semibold">Bumbu Dapur</h3>
                                <p class="text-sm text-gray-500">22 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Minuman -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🥤</span>
                            <div>
                                <h3 class="font-semibold">Minuman</h3>
                                <p class="text-sm text-gray-500">10 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Makanan Ringan -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🍪</span>
                            <div>
                                <h3 class="font-semibold">Makanan Ringan</h3>
                                <p class="text-sm text-gray-500">26 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Mie Instant -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🍜</span>
                            <div>
                                <h3 class="font-semibold">Mie Instant</h3>
                                <p class="text-sm text-gray-500">22 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Peralatan Mandi -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🧴</span>
                            <div>
                                <h3 class="font-semibold">Peralatan Mandi</h3>
                                <p class="text-sm text-gray-500">9 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Deterjen & Baju -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🧺</span>
                            <div>
                                <h3 class="font-semibold">Deterjen & Baju</h3>
                                <p class="text-sm text-gray-500">13 Produk Tersedia</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Rokok -->
                <div class="category-item">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="text-2xl">🚬</span>
                            <div>
                                <h3 class="font-semibold">Rokok</h3>
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
    </div>

    <script>
        let html5Qrcode = null;

        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanner
            stopScanner();
            
            // Close modal
            Swal.close();

            // Show loading
            Swal.fire({
                title: 'Mencari Produk',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Redirect ke halaman detail produk
            setTimeout(() => {
                window.location.href = `/products/scan/${encodeURIComponent(decodedText)}`;
            }, 1000);
        }

        async function showQrisModal() {
            const modal = await Swal.fire({
                title: 'Scan Barcode',
                html: `
                    <div id="reader" style="width: 100%"></div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="window.location.href='/products/search'" class="px-4 py-2 border border-blue-300 rounded-lg hover:bg-blue-50 mb-4 bg-blue-500 transition-colors text-white">
                            Cari Manual
                        </button>
                    </div>
                `,
                showConfirmButton: false,
                showCloseButton: true,
                allowOutsideClick: false,
                didOpen: async () => {
                    try {
                        html5Qrcode = new Html5Qrcode("reader");
                        const devices = await Html5Qrcode.getCameras();
                        if (devices && devices.length) {
                            const config = {
                                fps: 10,
                                qrbox: { width: 250, height: 250 },
                                aspectRatio: 1
                            };
                            await html5Qrcode.start(
                                { facingMode: "environment" }, 
                                config,
                                onScanSuccess
                            );
                        }
                    } catch (err) {
                        console.error("Error starting scanner:", err);
                        Swal.fire({
                            title: 'Error',
                            text: 'Tidak dapat mengakses kamera. Pastikan browser mendapat izin untuk mengakses kamera.',
                            icon: 'error'
                        });
                    }
                },
                willClose: () => {
                    stopScanner();
                }
            });
        }

        async function stopScanner() {
            if (html5Qrcode !== null) {
                try {
                    await html5Qrcode.stop();
                    html5Qrcode = null;
                } catch (err) {
                    console.error("Error stopping scanner:", err);
                }
            }
        }
    </script>

</body>
</html>