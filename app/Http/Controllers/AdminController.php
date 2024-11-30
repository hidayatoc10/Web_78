<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = User::where('keterangan', 'Murid', 'Guru')->count();
        $totalkelas = Kelas::count();
        return view("admin.dashboard", [
            "totalPengguna" => $totalPengguna,
            "totalKelas" => $totalkelas
        ]);
    }
    public function data_kelas()
    {
        $dataKelas = Kelas::orderBy("created_at", "desc")->get();
        return view('admin.kelas_admin', [
            'data' => $dataKelas,
        ]);
    }

    public function tambah_kelas(Request $request)
    {
        $validator = $request->validate([
            "kelas" => ["required", "min:3", "max:100"],
            "keterangan" => ["required", "string", "min:3", "max:200"],
        ]);

        Kelas::create([
            "kelas" => $request->kelas,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('data_kelas')->with("success", "Kelas berhasil di tambahkan");
    }

    public function hapus_kelas($kelas)
    {
        $cari_data = Kelas::where('kelas', $kelas)->first();
        if (!$cari_data) {
            return redirect()->route('data_kelas')->with('datatidaknemu', 'Kelas tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('data_kelas')->with('berhasil_hapus', 'Kelas berhasil dihapus');
        }
    }
    public function update_kelas(Request $request, $kelas)
    {
        $validator = $request->validate([
            "kelas" => ["required", "min:3", "max:100"],
            "keterangan" => ["required", "string", "min:3", "max:200"],
        ]);

        $kelas = Kelas::where('kelas', $kelas)->first();
        if (!$kelas) {
            return redirect()->route('data_kelas')->with('datatidaknemu', 'Kelas tidak ditemukan');
        }

        $kelas->update([
            "kelas" => $request->kelas,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('data_kelas')->with("berhasiledit", "Kelas berhasil diupdate");
    }

    public function mata_pelajaran()
    {
        $data = MataPelajaran::orderBy("created_at", "desc")->get();
        return view('admin.mata_pelajaran', [
            'data' => $data,
        ]);
    }

    public function tambah_pelajaran(Request $request)
    {
        $validator = $request->validate([
            "nama_pelajaran" => ["required", "min:3", "max:100"],
            "keterangan" => ["required", "string", "min:3", "max:200"],
        ]);

        MataPelajaran::create([
            "nama_pelajaran" => $request->nama_pelajaran,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('mata_pelajaran')->with("success", "Mata Pelajaran berhasil di tambahkan");
    }

    public function update_pelajaran(Request $request, $nama_pelajaran)
    {
        $validator = $request->validate([
            "nama_pelajaran" => ["required", "min:3", "max:100"],
            "keterangan" => ["required", "string", "min:3", "max:200"],
        ]);

        $nama_pelajaran = MataPelajaran::where('nama_pelajaran', $nama_pelajaran)->first();
        if (!$nama_pelajaran) {
            return redirect()->route('mata_pelajaran')->with('datatidaknemu', 'Mata pelajaran tidak ditemukan');
        }

        $nama_pelajaran->update([
            "nama_pelajaran" => $request->nama_pelajaran,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('mata_pelajaran')->with("berhasiledit", "Mata pelajaran berhasil diupdate");
    }
    public function hapus_pelajaran($nama_pelajaran)
    {
        $cari_data = MataPelajaran::where('nama_pelajaran', $nama_pelajaran)->first();
        if (!$cari_data) {
            return redirect()->route('mata_pelajaran')->with('datatidaknemu', 'Mata pelajaran tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('mata_pelajaran')->with('berhasil_hapus', 'Mata pelajaran berhasil dihapus');
        }
    }

    public function pengguna_sistem()
    {
        $data = User::whereIn('keterangan', ['Guru', 'Murid'])->orderBy('created_at', 'desc')->get();
        $dataKelas = Kelas::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna_sistem', [
            'data' => $data,
            'kelas' => $dataKelas,
        ]);
    }

    public function tambah_pengguna(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|min:3',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'keterangan' => 'required|in:Admin,Guru,Murid',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengguna_sistem')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update_pengguna(Request $request, $username)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:100|min:3',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'keterangan' => 'required|in:Admin,Guru,Murid',
        ]);

        $username = User::where('username', $username)->first();
        if (!$username) {
            return redirect()->route('pengguna_sistem')->with('datatidaknemu', 'Pengguna sistem tidak ditemukan');
        }

        $username->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengguna_sistem')->with("berhasiledit", "Pengguna sistem berhasil diupdate");
    }

    public function hapus_pengguna($username)
    {
        $cari_data = User::where('username', $username)->first();
        if (!$cari_data) {
            return redirect()->route('pengguna_sistem')->with('datatidaknemu', 'Pengguna sistem tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('pengguna_sistem')->with('berhasil_hapus', 'Pengguna sistem berhasil dihapus');
        }
    }

    public function akun_saya()
    {
        $kelas = Kelas::all();
        return view('admin.akun_saya', compact('kelas'));
    }
    public function update_akun(Request $request, $id)
    {
        $validated = $request->validate([
            'old_password' => 'required|string|min:8',
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'keterangan' => 'required|in:Admin,Guru,Murid',
            'password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        if (!Hash::check($validated['old_password'], $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'keterangan' => $validated['keterangan'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('akun_saya')->with('success', 'Akun berhasil diperbarui!');
    }
    public function siswa()
    {
        $nisn = User::where('keterangan', 'Murid')->orderBy('created_at', 'asc')->get();
        $kelas = Kelas::orderBy('created_at', 'asc')->get();
        $data = Siswa::orderBy('created_at', 'desc')->get();
        return view('admin.siswa', [
            'data' => $data,
            'nisn' => $nisn,
            'kelas' => $kelas
        ]);
    }

    public function tambah_siswa(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'nisn' => ['required', 'max:11', 'min:10'],
            'nis' => ['required', 'max:11', 'min:3'],
            'kelas_id' => ['required'],
            'jenis_kelamin' => 'required|in:Laki Laki,Perempuan',
        ]);

        Siswa::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('siswa')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function hapus_siswa($nisn)
    {
        $cari_data = Siswa::where('nisn', $nisn)->first();
        if (!$cari_data) {
            return redirect()->route('siswa')->with('datatidaknemu', 'Siswa tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('siswa')->with('berhasil_hapus', 'Siswa berhasil dihapus');
        }
    }

    public function guru()
    {
        $data = Guru::orderBy('created_at', 'desc')->get();
        $mapel = MataPelajaran::all();
        return view('admin.guru', [
            'data' => $data,
            'mapel' => $mapel
        ]);
    }

    public function tambah_guru(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string'],
            'nip' => ['required', 'min:5', 'max:50', 'unique:gurus,nip'],
            'no_telp' => ['required', 'min:8', 'max:20', 'unique:gurus,no_telp'],
            'mapel_id' => ['required'],
            'jenis_kelamin' => ['required', 'in:Laki Laki, Perempuan'],
        ]);

        Guru::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
            'mapel_id' => $request->mapel_id,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('guru')->with('success', 'Guru berhasil ditambahkan');
    }

    public function hapus_guru($nip)
    {
        $cari_data = Guru::where('nip', $nip)->first();
        if (!$cari_data) {
            return redirect()->route('guru')->with('datatidaknemu', 'Guru tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('guru')->with('berhasil_hapus', 'Guru berhasil dihapus');
        }
    }

    public function update_guru($nip, Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string'],
            'nip' => ['required', 'min:5', 'max:50', 'unique:gurus,nip'],
            'no_telp' => ['required', 'min:8', 'max:20', 'unique:gurus,no_telp'],
            'mapel_id' => ['required'],
            'jenis_kelamin' => ['required'],
        ]);

        $nip = Guru::where('nip', $nip)->first();
        if (!$nip) {
            return redirect()->route('guru')->with('datatidaknemu', 'Pengguna sistem tidak ditemukan');
        }

        $nip->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
            'mapel_id' => $request->mapel_id,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('guru')->with("berhasiledit", "Pengguna sistem berhasil diupdate");
    }

    public function materi()
    {
        $data = Materi::orderBy("created_at", "desc")->get();
        return view('admin.materi', [
            'data' => $data,
        ]);
    }
    public function hapus_materi($judul_materi)
    {
        $cari_data = Materi::where('judul_materi', $judul_materi)->first();
        if (!$cari_data) {
            return redirect()->route('materii')->with('datatidaknemu', 'Materi tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('materii')->with('berhasil_hapus', 'Materi berhasil dihapus');
        }
    }
    public function tugas()
    {
        $data = Tugas::orderBy("created_at", "desc")->get();
        return view('admin.tugas', [
            'data' => $data,
        ]);
    }
    public function hapus_tugas($judul_tugas)
    {
        $cari_data = Tugas::where('judul_tugas', $judul_tugas)->first();
        if (!$cari_data) {
            return redirect()->route('tugass')->with('datatidaknemu', 'Tugas tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('tugass')->with('berhasil_hapus', 'Tugas berhasil dihapus');
        }
    }
}