<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GuruController extends Controller
{
    public function dashboard_guru()
    {
        $totalPengguna = User::count();
        $totalkelas = Kelas::count();
        $user_id = auth()->user()->id;
        $totalMateri = Materi::where('user_id', $user_id)->count();
        return view("guru.dashboard_guru", [
            "totalPengguna" => $totalPengguna,
            "totalKelas" => $totalkelas,
            "totalMateri" => $totalMateri,
        ]);
    }

    public function materi()
    {
        $kelas = Kelas::all();
        $mata_pelajaran = MataPelajaran::all();
        $user_id = auth()->user()->id;
        $data = Materi::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('guru.materi', [
            'data' => $data,
            'kelas' => $kelas,
            'pelajaran' => $mata_pelajaran,
        ]);
    }

    public function tambah_materi(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'matapelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul_materi' => 'required|string|max:255',
            'descripsi' => 'nullable|string',
            'upload_materi' => 'required|file|mimes:pdf,jpeg,jpg,png,docx|max:1500',
        ]);
        $user = auth()->user();
        $filePath = null;
        if ($request->hasFile('upload_materi')) {
            $file = $request->file('upload_materi');
            $filePath = $file->storeAs('public/img_tugas', $file->getClientOriginalName());
        }
        Materi::create([
            'kelas_id' => $request->kelas_id,
            'matapelajaran_id' => $request->matapelajaran_id,
            'judul_materi' => $request->judul_materi,
            'descripsi' => $request->descripsi,
            'upload_materi' => $filePath,
            'user_id' => $user->id,
        ]);

        return redirect()->route('materi')->with('success', 'Materi successfully added.');
    }

    public function hapus_materi($judul_materi)
    {
        $cari_data = Materi::where('judul_materi', $judul_materi)->first();
        if (!$cari_data) {
            return redirect()->route('materi')->with('datatidaknemu', 'Materi tidak ditemukan');
        } else {
            $cari_data->delete();
            return redirect()->route('materi')->with('berhasil_hapus', 'Materi berhasil dihapus');
        }
    }

    public function akun_saya()
    {
        return view('guru.akun_saya');
    }

    public function tugas()
    {
        $kelas = Kelas::all();
        $mata_pelajaran = MataPelajaran::all();
        $user_id = auth()->user()->id;
        $data = Tugas::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('guru.tugas', [
            'data' => $data,
            'kelas' => $kelas,
            'pelajaran' => $mata_pelajaran,
        ]);
    }

    public function tambah_tugas(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'matapelajaran_id' => 'required|exists:mata_pelajarans,id',
            'judul_tugas' => 'required|string|max:255',
            'descripsi' => 'nullable|string|required',
            'upload_tugas' => 'required|file|mimes:pdf,jpeg,jpg,png,docx|max:1500',
        ]);
        $user = auth()->user();
        $filePath = null;
        if ($request->hasFile('upload_tugas')) {
            $file = $request->file('upload_tugas');
            $filePath = $file->storeAs('public/img_tugas', $file->getClientOriginalName());
        }
        tugas::create([
            'kelas_id' => $request->kelas_id,
            'matapelajaran_id' => $request->matapelajaran_id,
            'judul_tugas' => $request->judul_tugas,
            'descripsi' => $request->descripsi,
            'upload_tugas' => $filePath,
            'user_id' => $user->id,
        ]);

        return redirect()->route('tugas')->with('success', 'tugas successfully added.');
    }
}
