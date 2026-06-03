<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Backup Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-card p-10 text-center border border-gray-100">
        <div class="w-20 h-20 bg-primary-light text-primary-dark rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="ph ph-database text-4xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Cadangkan Database</h2>
        <p class="text-gray-500 text-sm mb-8">Klik tombol di bawah untuk mengunduh seluruh data Sistem Tani sebagai file SQL (.sql) untuk keamanan.</p>
        
        <a href="{{ route('admin.backup') }}" class="block w-full bg-primary-dark text-white font-bold py-4 rounded-xl hover:bg-primary-teal transition flex items-center justify-center gap-2">
            <i class="ph ph-download-simple text-xl"></i> Unduh File Backup SQL
        </a>
    </div>
</body>
</html>