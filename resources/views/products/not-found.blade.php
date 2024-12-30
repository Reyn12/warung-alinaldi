<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Tidak Ditemukan - Toko Alinaldi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <button onclick="showAddProductForm()" class="w-full bg-blue-500 text-white py-3 rounded-xl font-bold hover:bg-blue-600">
                    Tambah Produk Baru
                </button>
                <button onclick="window.location.href='/products/search'" class="w-full bg-white border-2 border-blue-500 text-blue-500 py-3 rounded-xl font-bold hover:bg-blue-50">
                    Cari Manual
                </button>
                <button onclick="window.location.href='/'" class="w-full border border-gray-300 text-gray-600 py-3 rounded-xl font-bold hover:bg-gray-50">
                    Scan Ulang
                </button>
            </div>
        </div>
    </div>

    <!-- Form Tambah Produk -->
    <script>
    // Fungsi untuk mengkompresi gambar
    function compressImage(file) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;
                    
                    // Hitung rasio untuk mempertahankan aspek ratio
                    const maxSize = 800;
                    if (width > height && width > maxSize) {
                        height = height * (maxSize / width);
                        width = maxSize;
                    } else if (height > maxSize) {
                        width = width * (maxSize / height);
                        height = maxSize;
                    }
                    
                    canvas.width = width;
                    canvas.height = height;
                    
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    
                    // Konversi ke blob dengan kualitas 0.7 (70%)
                    canvas.toBlob((blob) => {
                        resolve(new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        }));
                    }, 'image/jpeg', 0.7);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    async function showAddProductForm() {
        const { value: formValues } = await Swal.fire({
            title: 'Tambah Produk Baru',
            html: `
                <form id="addProductForm" class="space-y-4 text-left" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" class="w-full px-3 py-2 border rounded-lg" rows="2" required></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="price" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stock" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" class="w-full px-3 py-2 border rounded-lg" required>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
                        <input type="text" name="barcode" value="{{ $barcode }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Produk</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            preConfirm: async () => {
                const form = document.getElementById('addProductForm');
                const formData = new FormData(form);
                
                // Kompresi gambar sebelum upload
                const imageFile = formData.get('image');
                if (imageFile) {
                    const compressedImage = await compressImage(imageFile);
                    formData.set('image', compressedImage);
                }

                // Debug: Log form data
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                
                return fetch('/products', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Response:', text);
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    if (!data.success) {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                    return data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.showValidationMessage(error.message);
                });
            }
        });

        if (formValues) {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Produk baru telah ditambahkan',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = `/products/scan/${encodeURIComponent('{{ $barcode }}')}`;
            });
        }
    }
    </script>
</body>
</html>