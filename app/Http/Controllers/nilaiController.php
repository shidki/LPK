<?php

namespace App\Http\Controllers;

use App\Models\kompNilai;
use App\Models\nilai;
use App\Models\siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class nilaiController extends Controller
{
    public function getNilaiModal($id_siswa){
        $nilaiSiswaModal = kompNilai::select(
            "k.id_komp_nilai", 
            "k.nama_komp_nilai", 
            "n.id_nilai", 
            "n.nilai"
        )
        ->from('komp_nilais as k')
        ->leftJoin("nilais as n", function ($join) use ($id_siswa) {
            $join->on('n.id_komp_nilai', '=', 'k.id_komp_nilai')
                 ->where('n.id_siswa', '=', $id_siswa);
        })
        // Tidak perlu orWhereNull disini, karena LEFT JOIN sudah memastikan semua komponen nilai tetap muncul
        ->get();

        // Untuk komponen nilai yang tidak ada, atur nilai ke 0
        $nilaiSiswaModal = $nilaiSiswaModal->map(function ($item) {
            // Jika nilai null, set ke 0 atau nilai default lainnya
            if (is_null($item->nilai)) {
                $item->nilai = 0; // Bisa disesuaikan jika ingin null atau nilai default lainnya
            }
            return $item;
        });

        //Log::info($nilaiSiswaModal);
    
    
        // Kirimkan data nilai ke view modal
        return response()->json($nilaiSiswaModal);
    }

    public function edit_nilai_siswa(Request $request){
        $jawaban = $request->all();

        $idSiswa = $jawaban['id_siswa'];
        $nilaiData = [];
        foreach ($jawaban as $key => $value) {
            if (str_starts_with($key, 'nilai_')) {
                // Ambil id_komp_nilai dari nama input
                $idKompNilai = str_replace('nilai_', '', $key);
                //$idKompNilai = str_replace('nilai_', '', $key);
                // Simpan ke array nilaiData
                $nilaiData[] = [
                    'id_siswa' => $idSiswa,
                    'id_komp_nilai' => $idKompNilai,
                    'nilai' => $value,
                ];
            }

        }

        foreach ($nilaiData as $nilai) {
            // Periksa apakah nilai untuk siswa dan komponen ini sudah ada
            $existingNilai = Nilai::where('id_siswa', $nilai['id_siswa'])
                ->where('id_komp_nilai', $nilai['id_komp_nilai'])
                ->first();
    
            if ($existingNilai) {
                // kalau nilainya udah ada, brarti update
                if($nilai['nilai'] > 100){
                    return back()->with(['error_add' => "Nilai melebihi 100"]);
                }
                if($nilai['nilai'] < 0){
                    return back()->with(['error_add' => "Nilai tidak boleh kurang dari 0"]);
                }
                DB::table("nilais")->where("id_siswa",'=',$nilai['id_siswa'])->where('id_komp_nilai','=', $nilai['id_komp_nilai'])->update([
                    "nilai" => $nilai['nilai']
                ]);
            } else {
                // Tambahkan nilai baru jika belum ada
                if($nilai['nilai'] > 100){
                    return back()->with(['error_add' => "Nilai melebihi 100"]);
                }
                if($nilai['nilai'] < 0){
                    return back()->with(['error_add' => "Nilai tidak boleh kurang dari 0"]);
                }
                DB::table("nilais")->insert([
                    "nilai" => $nilai['nilai'],
                    "id_siswa" => $nilai['id_siswa'],
                    "id_komp_nilai" => $nilai['id_komp_nilai'],
                ]);
            }
        }

        return back()->with(['sukses_add' => "Berhasil mengubah nilai"]);

    }
    public function downloadTranskip($id_siswa){
        // Ambil data siswa berdasarkan ID
        $siswa = siswa::select("s.*",'k.nama_kelas','i.nama_ins')
        ->from("siswas as s")
        ->join("kelas as k",'k.id_kelas','=','s.id_kelas')
        ->join("instrukturs as i",'k.id_ins','=','i.id_ins')
        ->where("s.id_siswa",'=',$id_siswa)->first();

        //getNilai sesuai id siswa
        $nilai = nilai::select("n.*",'k.*')->from("nilais as n")
        ->join("komp_nilais as k",'k.id_komp_nilai','=','n.id_komp_nilai')
        ->where("n.id_siswa",'=',$id_siswa)->get();

        //dd($nilai);
        $kompnilai = kompNilai::get();
        // Ambil template HTML (bisa diambil dari Blade)
        $data = [
            'nama' => $siswa->nama,
            'alamat' => $siswa->alamat,
            'no_hp' => $siswa->no_hp,
            'email' => $siswa->email,
            'tgl' => $siswa->tgl_masuk,
            'instruktur' => $siswa->nama_ins,
            'kelas' => $siswa->nama_kelas,
            'komp_nilai' => [
            ],
            'transkip' => [
            ]
        ];

        foreach ($nilai as $n) {
            $data['transkip'][] = [
                'id_nilai' => $n->id_nilai,            // ID Nilai (bisa dimodifikasi sesuai kebutuhan)
                'Kategori_Nilai' => $n->nama_komp_nilai, // Nama Kompetensi Nilai
                'nilai' => $n->nilai,
                'proporsi_nilai' => $n->proporsi_nilai,
            ];
        }
        foreach ($kompnilai as $komp) {
            $data['komp_nilai'][] = [
                'Kategori_Nilai' => $komp->nama_komp_nilai, // Nama Kompetensi Nilai
                'proporsi_nilai' => $komp->proporsi_nilai, // Nama Kompetensi Nilai
            ];
        }

        //dd($data);
        // Load template dari Blade
        $pdf = Pdf::loadView('template.laporan_transkip', $data);

        // Simpan file PDF ke direktori
        return $pdf->download('transkip_nilai_' . $siswa->nama . '.pdf');
    }
    public function viewTranskip($id_siswa){
        // Ambil data siswa berdasarkan ID
        $siswa = siswa::select("s.*",'k.nama_kelas','i.nama_ins')
        ->from("siswas as s")
        ->join("kelas as k",'k.id_kelas','=','s.id_kelas')
        ->join("instrukturs as i",'k.id_ins','=','i.id_ins')
        ->where("s.id_siswa",'=',$id_siswa)->first();

        //getNilai sesuai id siswa
        $nilai = nilai::select("n.*",'k.*')->from("nilais as n")
        ->join("komp_nilais as k",'k.id_komp_nilai','=','n.id_komp_nilai')
        ->where("n.id_siswa",'=',$id_siswa)->get();

        //dd($nilai);
        $kompnilai = kompNilai::get();
        // Ambil template HTML (bisa diambil dari Blade)
        $data = [
            'nama' => $siswa->nama,
            'alamat' => $siswa->alamat,
            'no_hp' => $siswa->no_hp,
            'email' => $siswa->email,
            'tgl' => $siswa->tgl_masuk,
            'instruktur' => $siswa->nama_ins,
            'kelas' => $siswa->nama_kelas,
            'komp_nilai' => [
            ],
            'transkip' => [
            ]
        ];

        foreach ($nilai as $n) {
            $data['transkip'][] = [
                'id_nilai' => $n->id_nilai,            // ID Nilai (bisa dimodifikasi sesuai kebutuhan)
                'Kategori_Nilai' => $n->nama_komp_nilai, // Nama Kompetensi Nilai
                'nilai' => $n->nilai,
                'proporsi' => $n->proporsi_nilai,
            ];
        }
        foreach ($kompnilai as $komp) {
            $data['komp_nilai'][] = [
                'Kategori_Nilai' => $komp->nama_komp_nilai, // Nama Kompetensi Nilai
            ];
        }

        //dd($data);
        // Load template dari Blade
        $pdf = Pdf::loadView('template.laporan_transkip', $data);

        // Simpan file PDF ke direktori
        return view('template.laporan_transkip', $data);
    }
}
