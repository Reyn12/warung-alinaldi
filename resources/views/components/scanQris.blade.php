<!-- QRIS Scanner Modal -->
<div x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <!-- Modal -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-xl w-[90%] max-w-md p-4 transform transition-all">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Scan QRIS</h3>
                <button @click="toggle()" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Scanner Area -->
            <div class="bg-gray-100 rounded-lg p-4 mb-4">
                <div class="aspect-square relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <p class="text-gray-500 text-center">Arahkan kamera ke barcode produk</p>
                    </div>
                    <video id="qr-video" class="w-full h-full object-cover rounded-lg"></video>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button onclick="startScanner()" class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-600 transition-colors">
                    Scan Code
                </button>
                <button @click="toggle()" class="flex-1 border border-gray-300 py-2 px-4 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                    Input Manual
                </button>
            </div>
        </div>
    </div>
</div>
