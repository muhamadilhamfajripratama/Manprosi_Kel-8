<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Daftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#FFF5E4' }
                }
            }
        }
    </script>
</head>
{{-- Mengubah background warna solid menjadi gambar background cover dari folder assets --}}
<body class="font-sans h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat relative" 
      style="background-image: url('{{ asset('assets/pertanian-2.jpeg') }}');">
    
    {{-- Efek Overlay transparan gelap agar tulisan/form tetap terbaca --}}
    <div class="absolute inset-0 bg-primary-dark/50 backdrop-blur-[2px] z-0"></div>

    {{-- Menambahkan z-10 relative agar kotak putih form berada di atas gambar --}}
    <div class="bg-white p-8 rounded-[20px] shadow-2xl w-full max-w-md border border-gray-100 mt-10 mb-10 z-10 relative">
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-[12px] bg-primary-mid flex items-center justify-center mx-auto mb-4">
                <i class="ph ph-user-plus text-white text-[28px]"></i>
            </div>
            <h2 class="text-[24px] font-semibold text-primary-dark">Buat Akun</h2>
            <p class="text-[14px] text-gray-500 mt-1">Bergabunglah dengan Sistem Tani</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4 border border-red-100">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" required>
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" required>
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Mendaftar Sebagai</label>
                <select name="role" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" required>
                    <option value="petani" {{ old('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                    <option value="distributor" {{ old('role') == 'distributor' ? 'selected' : '' }}>Distributor</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Ulangi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-primary-mid text-white font-semibold rounded-[8px] py-3 mt-2 hover:bg-opacity-90 transition shadow-md">
                Daftar
            </button>
        </form>

        <p class="text-center text-[13px] text-gray-500 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-primary-dark font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>

</body>
</html>