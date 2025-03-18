<?php

namespace App\Http\Controllers;

use App\Models\kuis;
use App\Models\materi;
use App\Models\mapel;
use App\Models\opsi_pg;
use App\Models\siswa;
use App\Models\soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isEmpty;

class materiController extends Controller
{
    public function add_mapel(Request $request)
    {
        $mapel = $request->mapel;
        $tahun = $request->tahunAkademik;
        if (trim($mapel) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        // Cek apakah mapel sudah tersedia
        $getMapel = DB::table("mapels")->where("nama_mapel", '=', $mapel)->first();
        if ($getMapel) {
            return back()->with(["error_add" => "Judul bab sudah tersedia"]);
        }



        // Hitung jumlah mapel yang ada untuk id_mapel
        $lastMapelId = mapel::select(DB::raw('CAST(SUBSTRING(id_mapel, 6) AS UNSIGNED) AS angka'))
            ->orderBy('angka', 'desc')
            ->first();

        // Ambil hanya angka dari ID terakhir (jika ada)
        $lastNumber = $lastMapelId ? $lastMapelId->angka : 0;
        

        // Insert mapel ke database (dilakukan sekali saja)
        $insertMapel = DB::table("mapels")->insert([
            "id_mapel" => "BJP00" . ($lastNumber + 1),
            "nama_mapel" => $mapel,
            "thn_akademik" => $tahun,
        ]);

        if ($insertMapel == true) {
            $getMapel = mapel::where("nama_mapel",'=',$mapel)->first();
            // Ambil id_mapel yang baru dimasukkan
            $getIdMapel = DB::table("mapels")->where("nama_mapel", '=', $mapel)->first();

            // Proses setiap file materi
            $fileCount = 1;
            while ($request->has("file" . $fileCount)) {  // Pengecekan berdasarkan file
                if ($request->has("judulMateri" . $fileCount)) { // Pastikan ada judul materi untuk file ini
                    $judulMateri = $request->input("judulMateri" . $fileCount);
                    if (trim($judulMateri) === '') {
                        return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
                    }
                    if (strlen($judulMateri) > 25){
                        return back()->with(["error_add" => "Judul materi ke $fileCount melebihi 25 karakter"]);

                    }
                    // Cek apakah judul materi sudah ada
                    $getMateri = DB::table("materis")->where("judul_materi", '=', $judulMateri)->first();
                    if ($getMateri == true) {
                        return back()->with(["error_add" => "Judul Materi ". $judulMateri . " sudah tersedia"]);
                    }

                    // Cek apakah file di-upload
                    if ($request->hasFile("file" . $fileCount)) {
                        $file_materi = $request->file("file" . $fileCount);

                        // Validasi file untuk memastikan hanya PDF yang diizinkan
                        

                        // Pastikan file adalah PDF
                        // if ($file_materi->getClientOriginalExtension() !== 'pdf') {
                        //     return back()->with(["error_add" => "!"]);
                        // }

                        // Menyimpan file PDF dengan nama yang sesuai
                        $nama_file_materi = 'file_materi_' . $judulMateri ."." . $file_materi->getClientOriginalExtension();
                        // dd($nama_file_materi);
                        $file_materi->move('file/materi', $nama_file_materi);
                        $nama_file_materi_pembelajaran = 'file/materi/' . $nama_file_materi;

                        // Insert materi ke database
                        // get data mapel/bab yang udah ditambah sebelumnya
                        $getMapel = mapel::where("nama_mapel",'=',$mapel)->first();
                        $cekCountMateri = materi::where('id_mapel','=',$getMapel->id_mapel)->count();

                        $idMapel = $getMapel->id_mapel; // Ambil id_mapel yang sudah disimpan
                        $lastMateriId = materi::select(DB::raw("
                            CAST(SUBSTRING(
                                id_materi, 
                                LOCATE('$idMapel', id_materi) + LENGTH('$idMapel') 
                            ) AS UNSIGNED) AS angka
                        "))
                        ->where('id_mapel', '=', $idMapel)
                        ->orderBy('angka', 'desc')
                        ->first();
            
                    // Ambil hanya angka dari ID terakhir (jika ada)
                        $lastNumber = $lastMateriId ? $lastMateriId->angka : 0;

                        $insertMateri = DB::table("materis")->insert([
                            "id_materi" => "MBJP00" . $getMapel->id_mapel .($lastNumber + 1),
                            "judul_materi" => $judulMateri,
                            "dok_materi" => $nama_file_materi_pembelajaran,
                            "tgl_unggah" => now(),
                            "id_mapel" => $getIdMapel->id_mapel
                        ]);

                        // Menangani hasil insert materi
                        if (!$insertMateri) {
                            return back()->with(["error_add" => "Gagal menambah materi!"]);
                        }
                    } else {
                        return back()->with(["error_add" => "File materi tidak ditemukan!"]);
                    }
                }

                // Lanjutkan ke file berikutnya
                $fileCount++;
            }

            return back()->with(["sukses_add" => "Berhasil menambah materi!"]);
        } else {
            return back()->with(["error_add" => "Gagal menambah mapel!"]);
        }
    }

    public function delete_mapel($id) {
        $getMateri = materi::where("id_mapel", '=', $id)->get();
        // cek apakah mapel ada kuis atau engga ( klo ada brarti gabisa )
        $cekKuis = kuis::where("id_mapel",'=',$id)->first();
        if($cekKuis == true){
            return back()->with(["error_delete" => "Hapus kuis terlebih dahulu"]);
        }

        if((!$getMateri->isEmpty())){
            //dd(5);
            $deleteMateriStatus = false; // status materi berhasil dihapus atau engga
            foreach ($getMateri as $materi) {
                $dokMateriPath = $materi->dok_materi;
                $deleteFile = File::delete($dokMateriPath);    
                if ($deleteFile == true) {                
                    $deleteMateri = DB::table("materis")->where("id_materi", '=', $materi->id_materi)->delete();
                    if($deleteMateri == true){
                        $deleteMateriStatus = true;
                    }else{
                        $deleteMateriStatus = false;
                    }
                }
            }
            //dd($deleteMateriStatus);
            if($deleteMateriStatus == true){
                //dd(7);
                //menghapus kuis yang terhubung dengan mapel
                $getKuis = kuis::where("id_mapel",'=',$id)->first();
                if($getKuis == true){
                    $getSoal = soal::where("id_kuis",'=',$getKuis->id_kuis)->get();
                    foreach($getSoal as $item){
                        //dd($item->type_soal);
                        if($item->type_soal == "pilgan"){
                            // get opsi yang terhubung dengan soal
                            $getOpsi = opsi_pg::select("id_opsi")->where("id_soal",'=',$item->id_soal)->get();
                            foreach($getOpsi as $items){
                                $deleteOpsi = DB::table("opsi_pgs")->where("id_opsi",'=',$items->id_opsi)->delete();
                            }
                        }
                        //menghapus jawaban benar dari soal terkait
                        $deleteJawaban= DB::table("jawabans")->where("id_soal",'=',$item->id_soal)->delete();
                        if($deleteJawaban == false){
                            return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                        }
                        $deleteSoal= DB::table("soals")->where("id_soal",'=',$item->id_soal)->delete();
                        if($deleteSoal == false){
                            return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                        }
                    }
                    $deleteKuis = DB::table("kuis")->where("id_kuis",'=',$getKuis->id_kuis)->delete();
                    if($deleteKuis == true){
                        // menghapus data mapel
                        $deleteMapel = mapel::where("id_mapel",'=',$id)->delete();
                        if($deleteMapel == true){
                            return back()->with(["sukses_delete" => "Berhasil menghapus bab dan materi"]);
                        }else{
                            return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
                        }
                    }else{
                        return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                    }
                }else{
                    $deleteMapel = mapel::where("id_mapel",'=',$id)->delete();
                    if($deleteMapel == true){
                        return back()->with(["sukses_delete" => "Berhasil menghapus bab dan materi"]);
                    }else{
                        return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
                    }
                }
            }else{
                return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
            }
        }else{
            //dd(5);
            //dd(1);
            $getKuis = kuis::where("id_mapel",'=',$id)->first();
            if($getKuis == true){
                $getSoal = soal::where("id_kuis",'=',$getKuis->id_kuis)->get();
                foreach($getSoal as $item){
                    //dd($item->type_soal);
                    if($item->type_soal == "pilgan"){
                        // get opsi yang terhubung dengan soal
                        $getOpsi = opsi_pg::select("id_opsi")->where("id_soal",'=',$item->id_soal)->get();
                        foreach($getOpsi as $items){
                            $deleteOpsi = DB::table("opsi_pgs")->where("id_opsi",'=',$items->id_opsi)->delete();
                        }
                    }
                    //menghapus jawaban benar dari soal terkait
                    $deleteJawaban= DB::table("jawabans")->where("id_soal",'=',$item->id_soal)->delete();
                    if($deleteJawaban == false){
                        return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                    }
                    $deleteSoal= DB::table("soals")->where("id_soal",'=',$item->id_soal)->delete();
                    if($deleteSoal == false){
                        return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                    }
                }
                $deleteKuis = DB::table("kuis")->where("id_kuis",'=',$getKuis->id_kuis)->delete();
                if($deleteKuis == true){
                    // menghapus data mapel
                    $deleteMapel = mapel::where("id_mapel",'=',$id)->delete();
                    if($deleteMapel == true){
                        return back()->with(["sukses_delete" => "Berhasil menghapus bab dan materi"]);
                    }else{
                        return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
                    }
                }else{
                    return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
                }
            }else{
                $deleteMapel = mapel::where("id_mapel",'=',$id)->delete();
                if($deleteMapel == true){
                    return back()->with(["sukses_delete" => "Berhasil menghapus bab dan materi"]);
                }else{
                    return back()->with(["error_delete" => "Gagal menghapus bab dan materi"]);
                }
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

    public function edit_mapel(Request $request){
        $id = $request->mapelss;
        $mapel = $request->mapelEdit;
        $tahun = $request->tahunAkademikEdit;
        //dd($tahun);
        // Cek apakah mapel sudah tersedia
        //dd(5);
        if (trim($mapel) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        $cekMapel = DB::table("mapels")->where("nama_mapel", '=', $mapel)->where('id_mapel','!=',$id)->first();
        if ($cekMapel) {
            return back()->with(["error_add" => "Judul bab sudah tersedia!"]);
        }

        $getMapel = mapel::where("id_mapel",'=',$id)->first();
        if($getMapel->nama_mapel !== $mapel || $getMapel->thn_akademik !== $tahun){
            $updateMapel = DB::table("mapels")->where("id_mapel",'=',$id)->update([
                "nama_mapel" => $mapel,
                "thn_akademik" => $tahun,
            ]);
            if($updateMapel == true){
                // Proses setiap file materi
                $fileCount = 1;
                while ($request->has("fileEdit" . $fileCount)) {  // Pengecekan berdasarkan file
                    if ($request->has("judulMateriEdit" . $fileCount)) { // Pastikan ada judul materi untuk file ini
                        $judulMateri = $request->input("judulMateriEdit" . $fileCount);
                        if (trim($judulMateri) === '') {
                            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
                        }
                        if (strlen($judulMateri) > 25){
                            return back()->with(["error_add" => "Judul materi ke $fileCount melebihi 25 karakter"]);
                        }
                        // Cek apakah judul materi sudah ada
                        //dd($judulMateri);
                        $getMateri = DB::table("materis")->where("judul_materi", '=', $judulMateri)->first();
                        if ($getMateri == true) {
                            return back()->with(["error_add" => "Judul Materi ". $judulMateri . " sudah tersedia"]);
                        }
    
                        // Cek apakah file di-upload
                        if ($request->hasFile("fileEdit" . $fileCount)) {
                            $file_materi = $request->file("fileEdit" . $fileCount);
    
                            // Validasi file untuk memastikan hanya PDF yang diizinkan
                            $validatedData = $request->validate([
                                "file" . $fileCount => '|max:100240', // max 10MB
                            ]);
    
                            // Pastikan file adalah PDF
                            // if ($file_materi->getClientOriginalExtension() !== 'pdf') {
                            //     return back()->with(["error_add" => "Hanya file PDF yang diperbolehkan!"]);
                            // }
    
                            // Menyimpan file PDF dengan nama yang sesuai
                            $nama_file_materi = 'file_materi_' . $judulMateri . '.' . $file_materi->getClientOriginalExtension();
                            $file_materi->move('file/materi', $nama_file_materi);
                            $nama_file_materi_pembelajaran = 'file/materi/' . $nama_file_materi;
    
                            // Insert materi ke database
                            $cekCountMateri = materi::count();
                            $idMapel = $getMapel->id_mapel;
                            $lastMateriId = materi::select(DB::raw("
                            CAST(SUBSTRING(
                                id_materi, 
                                LOCATE('$idMapel', id_materi) + LENGTH('$idMapel') 
                            ) AS UNSIGNED) AS angka
                        "))
                        ->where('id_mapel', '=', $idMapel)
                        ->orderBy('angka', 'desc')
                        ->first();
                        
                
                        // Ambil hanya angka dari ID terakhir (jika ada)
                            $lastNumber = $lastMateriId ? $lastMateriId->angka : 0;
                            
                            $insertMateri = DB::table("materis")->insert([
                                "id_materi" => "MBJP00" . $getMapel->id_mapel .($lastNumber + 1),
                                "judul_materi" => $judulMateri,
                                "dok_materi" => $nama_file_materi_pembelajaran,
                                "tgl_unggah" => now(),
                                "id_mapel" => $id
                            ]);
    
                            // Menangani hasil insert materi
                            if (!$insertMateri) {
                                return back()->with(["error_add" => "Gagal menambah materi!"]);
                            }
                        } else {
                            return back()->with(["error_add" => "File materi tidak ditemukan!"]);
                        }
                    }
                    // Lanjutkan ke file berikutnya
                    $fileCount++;
                }
                return back()->with(["sukses_edit" => "Berhasil mengubah bab!"]);
            }else{
                return back()->with(["error_edit" => "Gagal mengubah bab!"]);
    
            }
        }else{
            // Proses setiap file materi
            $fileCount = 1;
            while ($request->has("fileEdit" . $fileCount)) {  // Pengecekan berdasarkan file
                if ($request->has("judulMateriEdit" . $fileCount)) { // Pastikan ada judul materi untuk file ini
                    $judulMateri = $request->input("judulMateriEdit" . $fileCount);
                    if (trim($judulMateri) === '') {
                        return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
                    }
                    if (strlen($judulMateri) > 25){
                        return back()->with(["error_add" => "Judul materi ke $fileCount melebihi 25 karakter"]);
                    }
                    // Cek apakah judul materi sudah ada
                    //dd($judulMateri);
                    $getMateri = DB::table("materis")->where("judul_materi", '=', $judulMateri)->first();
                    if ($getMateri == true) {
                        return back()->with(["error_add" => "Judul Materi ". $judulMateri . " sudah tersedia"]);
                    }

                    // Cek apakah file di-upload
                    if ($request->hasFile("fileEdit" . $fileCount)) {
                        $file_materi = $request->file("fileEdit" . $fileCount);



                        // Pastikan file adalah PDF
                        // if ($file_materi->getClientOriginalExtension() !== 'pdf') {
                        //     return back()->with(["error_add" => "!"]);
                        // }

                        // Menyimpan file PDF dengan nama yang sesuai
                        $nama_file_materi = 'file_materi_' . $judulMateri . '.' . $file_materi->getClientOriginalExtension();
                        
                        $file_materi->move('file/materi', $nama_file_materi);
                        $nama_file_materi_pembelajaran = 'file/materi/' . $nama_file_materi;

                        // Insert materi ke database
                        $idMapel = $getMapel->id_mapel;
                        $lastMateriId = materi::select(DB::raw("
                            CAST(SUBSTRING(
                                id_materi, 
                                LOCATE('$idMapel', id_materi) + LENGTH('$idMapel') 
                            ) AS UNSIGNED) AS angka
                        "))
                        ->where('id_mapel', '=', $idMapel)
                        ->orderBy('angka', 'desc')
                        ->first();
                        $lastNumber = $lastMateriId ? $lastMateriId->angka : 0;
                        //dd($lastNumber);

                        $insertMateri = DB::table("materis")->insert([
                            "id_materi" => "MBJP00" . $getMapel->id_mapel .($lastNumber + 1),

                            "judul_materi" => $judulMateri,
                            "dok_materi" => $nama_file_materi_pembelajaran,
                            "tgl_unggah" => now(),
                            "id_mapel" => $id
                        ]);

                        // Menangani hasil insert materi
                        if (!$insertMateri) {
                            return back()->with(["error_add" => "Gagal menambah materi!"]);
                        }
                    } else {
                        return back()->with(["error_add" => "File materi tidak ditemukan!"]);
                    }
                }

                // Lanjutkan ke file berikutnya
                $fileCount++;
            }
            return back()->with(["sukses_edit" => "Berhasil mengubah bab!"]);
        }
    }

    public function ubah_status_materi($id_mapel, $id_materi){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }


        // cek apakah materi yang dipencet itu materi terbaru atau bukan

        // cek progress materi
            $cekProgressMateri = siswa::where("email",'=',$email)->first();
            $idMapelTerpilih = (int) substr($id_mapel, 5);
            $idMapelProgress = (int) substr($cekProgressMateri->progress_mapel, 5);
            $idMateriTerpilih = (int) substr($id_materi, 12);
            $idMateriProgress = (int) substr($cekProgressMateri->progress_materi, 12);
            // jika mapel yang dipilih id nya lebih besar dari progress mapel yang udah diraih siswa, brarti update progress mapel
            //dd($idMapelTerpilih . " ============= ". $idMapelProgress );
            if($idMapelTerpilih > $idMapelProgress){
                $updateProgressMateri = DB::table("siswas")->where("email",'=',$email)->update([
                    "progress_materi" => $id_materi
                ]);

                // cek apakah progress materi adalah materi terakhir yang ada pada progress mapel
                $getMateri = materi::where("id_mapel",'=',$id_mapel)->get();
                $materiTerbesar = 0; // mengambil id materii terakhir pada mapel terkait
                foreach($getMateri as $materis){
                    $idMateri = (int) substr($materis->id_materi, 12);
                    if($idMateri > $materiTerbesar){
                        $materiTerbesar = $idMateri;
                    }
                }
                $idMateriCv = 'MBJP00'.$id_mapel.$materiTerbesar;
                //dd($idMateriCv);
                if($id_materi == $idMateriCv){
                    $updateProgressMateri = DB::table("siswas")->where("email",'=',$email)->update([
                        "progress_mapel" => $id_mapel
                    ]);
                }
            }elseif($idMapelTerpilih == $idMapelProgress){
                if($idMateriTerpilih > $idMateriProgress){
                    $updateProgressMateri = DB::table("siswas")->where("email",'=',$email)->update([
                        "progress_materi" => $id_materi
                    ]);
                }
            }
        return back();
    }

    public function edit_materi(Request $request)
    {
        $id = $request->id_materi_modal;
        $nama = $request->materiEditModal;

        // Ambil file dari request
        $file = $request->file('filemateriEditModal'); // Pastikan nama input file di form adalah 'filemateriEditModal'
        // dd($file->getClientOriginalExtension());
        //dd($file);
        // Cek apakah judul materi sudah ada
        $cekMateri = materi::where("judul_materi", '=', $nama)
            ->where("id_materi", '!=', $id)
            ->first();
        if (strlen($nama) > 25){
            return back()->with(["error_add" => "Judul materi  melebihi 25 karakter"]);
        }
        if ($cekMateri) {
            return back()->with(['error_edit' => "Judul materi sudah tersedia!"]);
        }
    
        // Jika tidak ada file yang diunggah
        if ($file == null) {
            $update = DB::table("materis")->where("id_materi", '=', $id)->update([
                "judul_materi" => $nama
            ]);
            if ($update) {
                return back()->with(['sukses_edit' => "Berhasil mengubah materi!"]);
            } else {
                return back()->with(['error_edit' => "Gagal mengubah materi!"]);
            }
        } else {
            // Jika ada file yang diunggah
            $cekMateri2 = materi::where("id_materi", '=', $id)->first();
    
            if ($cekMateri2 && $cekMateri2->dok_materi) {
                $filePath = public_path($cekMateri2->dok_materi); // Pastikan path ke file sesuai
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file lama dari storage
                }
            }

            
            // Validasi file untuk memastikan hanya PDF yang diizinkan
            $validatedData = $request->validate([
                'filemateriEditModal' => 'required|max:10240', // max 10MB
            ]);
            
            // Menyimpan file PDF dengan nama yang sesuai
            $nama_file_materi = 'file_materi_' . $nama . '.' . $file->getClientOriginalExtension();
            // $nama_file_materi = $request->file('filemateriEditModal')->getClientOriginalExtension();
            
            $file->move(public_path('file/materi'), $nama_file_materi);
            $nama_file_materi_pembelajaran = 'file/materi/' . $nama_file_materi;
            //dd($nama_file_materi_pembelajaran);
            
            // cek judul materi berubah apa ga
            $cekMateri3 = materi::
            where("id_materi", '=', $id)
            ->first();

            if($cekMateri3->judul_materi != $nama){
                //dd(4);
                // Update data di database
                $update = DB::table("materis")->where("id_materi", '=', $id)->update([
                    "judul_materi" => $nama,
                    "dok_materi" => $nama_file_materi_pembelajaran,
                ]);
        
                if ($update) {
                    return back()->with(['sukses_edit' => "Berhasil mengubah materi!"]);
                } else {
                    return back()->with(['error_edit' => "Gagal mengubah materi!"]);
                }
            }else{
                //dd(5);
                $update = DB::table("materis")->where("id_materi", '=', $id)->update([
                    "dok_materi" => $nama_file_materi_pembelajaran,
                ]);
                
                return back()->with(['sukses_edit' => "Berhasil mengubah materi!"]);
                //if ($update) {
                //    return back()->with(['sukses_edit' => "Berhasil mengubah materi!"]);
                //} else {
                //    return back()->with(['error_edit' => "Gagal mengubah materi!"]);
                //}
            }

        }
    }    
}
