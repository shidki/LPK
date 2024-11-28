<?php

namespace App\Http\Controllers;

use App\Models\materi;
use App\Models\mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class materiController extends Controller
{
    public function add_mapel(Request $request)
    {
        $mapel = $request->mapel;
        $tahun = $request->tahunAkademik;

        // Cek apakah mapel sudah tersedia
        $getMapel = DB::table("mapels")->where("nama_mapel", '=', $mapel)->first();
        if ($getMapel) {
            return back()->with(["error_add" => "Judul Bab sudah tersedia"]);
        }

        // Hitung jumlah mapel yang ada untuk id_mapel
        $cekCountMapel = mapel::count();

        // Insert mapel ke database (dilakukan sekali saja)
        $insertMapel = DB::table("mapels")->insert([
            "id_mapel" => "BJP00" . ($cekCountMapel + 1),
            "nama_mapel" => $mapel,
            "thn_akademik" => $tahun,
        ]);

        if ($insertMapel == true) {
            // Ambil id_mapel yang baru dimasukkan
            $getIdMapel = DB::table("mapels")->where("nama_mapel", '=', $mapel)->first();

            // Proses setiap file materi
            $fileCount = 1;
            while ($request->has("file" . $fileCount)) {  // Pengecekan berdasarkan file
                if ($request->has("judulMateri" . $fileCount)) { // Pastikan ada judul materi untuk file ini
                    $judulMateri = $request->input("judulMateri" . $fileCount);

                    // Cek apakah judul materi sudah ada
                    $getMateri = DB::table("materis")->where("judul_materi", '=', $judulMateri)->first();
                    if ($getMateri == true) {
                        return back()->with(["error_add" => "Judul Materi ". $judulMateri . " sudah tersedia"]);
                    }

                    // Cek apakah file di-upload
                    if ($request->hasFile("file" . $fileCount)) {
                        $file_materi = $request->file("file" . $fileCount);

                        // Validasi file untuk memastikan hanya PDF yang diizinkan
                        $validatedData = $request->validate([
                            "file" . $fileCount => 'mimes:pdf|max:100240', // max 10MB
                        ]);

                        // Pastikan file adalah PDF
                        if ($file_materi->getClientOriginalExtension() !== 'pdf') {
                            return back()->with(["error_add" => "Hanya file PDF yang diperbolehkan"]);
                        }

                        // Menyimpan file PDF dengan nama yang sesuai
                        $nama_file_materi = 'file_materi_' . $judulMateri . '.pdf';
                        $file_materi->move('file/materi', $nama_file_materi);
                        $nama_file_materi_pembelajaran = 'file/materi/' . $nama_file_materi;

                        // Insert materi ke database
                        $cekCountMateri = materi::count();
                        $insertMateri = DB::table("materis")->insert([
                            "id_materi" => "MBJP00" . ($cekCountMateri + 1),
                            "judul_materi" => $judulMateri,
                            "dok_materi" => $nama_file_materi_pembelajaran,
                            "materi_fav" => 0,
                            "tgl_unggah" => now(),
                            "id_mapel" => $getIdMapel->id_mapel
                        ]);

                        // Menangani hasil insert materi
                        if (!$insertMateri) {
                            return back()->with(["error_add" => "Gagal menambah Materi "]);
                        }
                    } else {
                        return back()->with(["error_add" => "File materi tidak ditemukan"]);
                    }
                }

                // Lanjutkan ke file berikutnya
                $fileCount++;
            }

            return back()->with(["sukses_add" => "Berhasil menambah Materi"]);
        } else {
            return back()->with(["error_add" => "Gagal menambah Mapel"]);
        }
    }

    public function delete_mapel($id) {
        $getMateri = materi::where("id_mapel", '=', $id)->get();
        $deleteMateriStatus = false; // status materi berhasil dihapus atau engga
        foreach ($getMateri as $materi) {
            $dokMateriPath = $materi->dok_materi;
            $deleteFile = File::delete($dokMateriPath);    
            if ($deleteFile) {                
                $deleteMateri = DB::table("materis")->where("id_materi", '=', $materi->id_materi)->delete();
                if($deleteMateri == true){
                    $deleteMateriStatus = true;
                }else{
                    $deleteMateriStatus = false;
                }
            }
        }
        if($deleteMateriStatus == true){
            // menghapus data mapel
            $deleteMapel = mapel::where("id_mapel",'=',$id)->delete();
            if($deleteMapel == true){
                return back()->with(["sukses_delete" => "Berhasil menghapus bab dan materi"]);
            }else{
                return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
            }
        }
    }

    public function delete_materi($id){
        $getMateri = materi::where("id_materi",'=',$id)->first();
        $dokMateriPath = $getMateri->dok_materi;
        $deleteFile = File::delete($dokMateriPath);
        if($deleteFile == true){
            $deleteMateri = materi::where("id_materi",'=',$id)->delete();
            if($deleteMateri == true){
                return back()->with(["sukses_delete" => "Berhasil menghapus materi"]);
            }else{
                return back()->with(["error_delete" => "Gagal menghapus materi"]);
            }
        }else{
            return back()->with(["error_delete" => "Gagal menghapus materi"]);
        }
    }
}
