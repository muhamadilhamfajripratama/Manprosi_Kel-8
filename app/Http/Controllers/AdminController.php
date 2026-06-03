<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ==========================================
    // FUNGSI GEMBOK KEAMANAN KHUSUS ADMIN
    // ==========================================
    private function batasiAksesAdmin()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            abort(403, 'AKSES DITOLAK! Halaman ini hanya khusus untuk Administrator.');
        }
    }

    public function pengguna()
    {
        $this->batasiAksesAdmin(); // Kunci terpasang

        // Tarik semua data pengguna, urutkan dari yang terbaru mendaftar
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna', compact('users'));
    }

    public function storePengguna(Request $request)
    {
        $this->batasiAksesAdmin(); // Kunci terpasang

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petani,distributor,konsumen'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function updatePengguna(Request $request, $id)
    {
        $this->batasiAksesAdmin(); // Kunci terpasang

        $user = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,petani,distributor,konsumen'
        ];
        
        // Jika password diisi, berarti admin ingin mengganti password user tersebut
        if($request->filled('password')) {
            $rules['password'] = 'min:6';
            $user->password = Hash::make($request->password);
        }

        $request->validate($rules);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

public function backup()
    {
        $this->batasiAksesAdmin();

        $database = env('DB_DATABASE', 'db_pertanian');
        $filename = "backup-{$database}-" . date('Y-m-d_His') . ".sql";
        $filepath = storage_path('app/' . $filename);

        // 1. Coba gunakan mysqldump XAMPP (Windows)
        $xamppPath = 'c:\xampp\mysql\bin\mysqldump';
        $cmd = (file_exists($xamppPath . '.exe') ? $xamppPath : 'mysqldump') . " --user=" . env('DB_USERNAME', 'root') . " --password=" . env('DB_PASSWORD', '') . " " . $database . " > " . '"' . $filepath . '"';
        if (function_exists('exec')) {
        @exec($cmd);
    }

        // 2. FALLBACK: Jika file gagal dibuat, ekspor manual menggunakan PHP
        if (!file_exists($filepath) || filesize($filepath) == 0) {
            $sql = "-- Backup Data Sistem Tani\n-- Diekspor pada: " . now() . "\n\n";
            $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
            
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                $rows = \Illuminate\Support\Facades\DB::table($tableName)->get();
                if(count($rows) > 0) {
                    $sql .= "-- Isi Data Tabel `{$tableName}`\n";
                    foreach ($rows as $row) {
                        $values = array_map(function($v) { return is_null($v) ? 'NULL' : "'" . addslashes($v) . "'"; }, (array)$row);
                        $sql .= "INSERT INTO `{$tableName}` (" . implode(', ', array_keys((array)$row)) . ") VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sql .= "\n";
                }
            }
            file_put_contents($filepath, $sql);
        }

        return response()->download($filepath)->deleteFileAfterSend(true);
    }

    public function destroyPengguna($id)
    {
        $this->batasiAksesAdmin(); // Kunci terpasang

        $user = User::findOrFail($id);
        
        // Proteksi: Admin tidak boleh menghapus akunnya sendiri yang sedang dipakai
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Akses Ditolak! Anda tidak bisa menghapus akun Anda sendiri.');
        }
        
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus dari sistem!');
    }
}