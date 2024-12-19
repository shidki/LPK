<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use App\Models\kuis;
use App\Models\log_kuis;
use App\Models\nilai_kuis;
use App\Models\opsi_pg;
use App\Models\riwayat_pengerjaan;
use App\Models\riwayat_pengerjaans;
use App\Models\siswa;
use App\Models\soal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class soalController extends Controller
{
    //
    public function add_soal(Request $request){

        $idKuis = $request->kuiss;
        $soal = $request->soal;
        $tipe_soal = $request->tipe_soal;
        //$isian = $request->isian;
        $opsiA = $request->opsiA;
        $opsiB = $request->opsiB;
        $opsiC = $request->opsiC;
        $opsiD = $request->opsiD;
        if (trim($soal) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        $jawabanBenar = $request->checkOpsi;

        // menambah data ke table soal dlu
        // cek pertanyaan udha ad apa blom\
        $getPertanyaan = soal::where("pertanyaan",'=',$soal)->first();
        if($getPertanyaan == true){
            return back()->with(['error_add' => "Pertanyaan sudah tersedia!"]);
        }

        //jika belum memilih jawaban yang benar
        if($tipe_soal == 'pilgan'){
            if($jawabanBenar == null){
                return back()->with(['error_add' => "Kunci jawaban belum dibuat pada soal ini!"]);
            }
        }

        $insertSoal = DB::table("soals")->insert([
            "pertanyaan" => $soal,
            "type_soal" => $tipe_soal,
            "id_kuis" => $idKuis
        ]);
        if($insertSoal == true){
            $getSoal = soal::where("pertanyaan",'=',$soal)->first();
            if($tipe_soal == 'pilgan'){
                // menambah data ke opsi jawban dlu
                if (trim($opsiA) === '' || trim($opsiB) === ''|| trim($opsiC) === ''|| trim($opsiD) === '') {
                    return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
                }
                $insertOpsiA = DB::table("opsi_pgs")->insert([
                    "opsi" => $opsiA,
                    "id_soal" => $getSoal->id_soal,
                ]);
                if($insertOpsiA == true){
                    $cekOpsiB = opsi_pg::where("opsi",'=',$opsiB)->where("id_soal",'=',$getSoal->id_soal)->first();
                        if($cekOpsiB == true){
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteSoal){
                                return back()->with(['error_add' => "Isi dari Opsi B sudah tersedia pada soal ini!"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                            }
                        }
                    $insertOpsiB = DB::table("opsi_pgs")->insert([
                        "opsi" => $opsiB,
                        "id_soal" => $getSoal->id_soal,
                    ]);
                    if($insertOpsiB == true){
                        $cekOpsiC = opsi_pg::where("opsi",'=',$opsiC)->where("id_soal",'=',$getSoal->id_soal)->first();
                        if($cekOpsiC == true){
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteOpsiB && $deleteSoal){
                                return back()->with(['error_add' => "Isi dari Opsi C sudah tersedia pada soal ini!"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                            }
                        }
                        $insertOpsiC = DB::table("opsi_pgs")->insert([
                            "opsi" => $opsiC,
                            "id_soal" => $getSoal->id_soal,
                        ]);
                        if($insertOpsiC == true){
                            $cekOpsiD = opsi_pg::where("opsi",'=',$opsiD)->where("id_soal",'=',$getSoal->id_soal)->first();
                            if($cekOpsiD == true){
                                $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteSoal){
                                    return back()->with(['error_add' => "Isi dari Opsi D sudah tersedia pada soal ini!"]);
                                }else{
                                    return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                                }
                            }
                            $insertOpsiD = DB::table("opsi_pgs")->insert([
                                "opsi" => $opsiD,
                                "id_soal" => $getSoal->id_soal,
                            ]);
                            if($insertOpsiD == true){
                                // setelah berhasil menambah semua opsi, sekaang menambah data untuk jawban yang benar ke table jawaban
                                $insertJawaban = DB::table("jawabans")->insert([
                                    "id_soal" => $getSoal->id_soal,
                                    "jawaban" => $jawabanBenar,
                                ]);
                                if($insertJawaban == true){
                                    return back()->with(['sukses_add' => "Berhasil menambah soal! beserta jawaban!"]);
                                }else{
                                    // jika jawaban benar gagal ditambahkan maka menghhaopus data soal dan semua opsi jawaban
                                    //jika gagal menambah opsi D, maka menghapus data soal dan opsi A B C
                                    $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                    $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                    $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                    $deleteOpsiD = opsi_pg::where("opsi",'=',$opsiD)->delete();
                                    $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                    if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteOpsiD && $deleteSoal){
                                        return back()->with(['error_add' => "Gagal menambah soal beserta jawaban"]);
                                    }else{
                                        return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                                    }
                                }
                            }else{
                                //jika gagal menambah opsi D, maka menghapus data soal dan opsi A B C
                                $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteSoal){
                                    return back()->with(['error_add' => "Gagal menambah soal karena terdapat opsi yang sama!!"]);
                                }else{
                                    return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                                }
                            }
                        }else{
                            //jika gagal menambah opsi C, maka menghapus data soal dan opsi A B
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteOpsiB && $deleteSoal){
                                return back()->with(['error_add' => "Gagal menambah soal karena terdapat opsi yang sama!"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                            }
                        }
                    }
                    else{
                        //jika gagal menambah opsi B, maka menghapus data soal dan opsi A
                        $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                        $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                        if($deleteOpsiA && $deleteSoal){
                            return back()->with(['error_add' => "Gagal menambah soal karena terdapat opsi yang sama!"]);
                        }else{
                            return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                        }
                    }
                }
                else{
                    //jika gagal menambah opsi A, maka menghapus data soal 
                    $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                    if($deleteSoal == true){
                        return back()->with(['error_add' => "Gagal menambah soal karena terdapat opsi yang sama!"]);
                    }else{
                        return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal!"]);
                    }
                }
            }
            //else{
            //    if($tipe_soal == "isian"){
            //        // karena tipe nya isiam, jadi langsung nambahin jawban ke table jawaban
            //        $insertJawabanIsian = DB::table("jawabans")->insert([
            //            "jawaban" => $isian,
            //            "id_soal" => $getSoal->id_soal,
            //        ]);
            //        if($insertJawabanIsian == true){
            //            return back()->with(['sukses_add' => "berhasil menambah soal! beserta jawaban"]);
            //        }else{
                        
            //            // jika gagal, menghapus data soal yang telah ditambah sebelumnya dlu
            //            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
            //            if($deleteSoal == true){
            //                return back()->with(['error_add' => "Gagal Menambah soal beserta jawaban"]);
            //            }else{
            //                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal"]);
            //            }
            //        }
            //    }
            //}
            return back()->with(['sukses_add' => "Berhasil menambah soal!"]);
        }else{
            return back()->with(['error_add' => "Gagal menambah soal!"]);
        }
    }

    public function delete_soal($id){
        $getDataSoal = soal::where("id_soal",'=',$id)->first();
        // jika soal udah dikerjain oleh siswa ( udah ada yang ngerjain soal ini, brarti gabisa dihapus )
        $cekSoal = riwayat_pengerjaan::where('id_soal','=',$id)->first();
        if($cekSoal == true ){
            return back()->with(['error_delete' => "Soal telah dikerjakan siswa!"]);
        }
        if($getDataSoal->type_soal == "pilgan"){
            $deleteJawaban = DB::table("jawabans")->where("id_soal",'=',$id)->delete();
            if($deleteJawaban == true){
                $deleteOpsi= DB::table("opsi_pgs")->where("id_soal",'=',$id)->delete();
                if($deleteOpsi == true){
                    $deleteSoal= DB::table("soals")->where("id_soal",'=',$id)->delete();
                    if($deleteSoal == true){
                        return back()->with(['sukses_delete' => "Berhasil Menghapus Soal!"]);
                    }else{
                        return back()->with(['error_delete' => "Gagal Menghapus Soal!"]);
                    }
                }else{
                    return back()->with(['error_delete' => "Gagal Menghapus Soal!"]);
                }
            }else{
                return back()->with(['error_delete' => "Gagal Menghapus Soal!"]);
            }
        }else{
            $deleteSoal= DB::table("soals")->where("id_soal",'=',$id)->delete();
            if($deleteSoal == true){
                return back()->with(['sukses_delete' => "Berhasil Menghapus Soal!"]);
            }else{
                return back()->with(['error_delete' => "Gagal Menghapus Soal!"]);
            }
        }
    }

    public function edit_soal(Request $request){
        $idSoal = $request->soalss;
        $soal = $request->soal;
        $isian = $request->isian;
        if (trim($soal) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        //cek apakah soal udah dipake atau belum
        $cekSoal = soal::where("pertanyaan",'=',$soal)->where("id_soal",'!=',$idSoal)->first();
        if($cekSoal == true){
            return back()->with(['error_edit' => "P"]);
        }
        $updateSoal = DB::table("soals")->where("id_soal",'=',$idSoal)->update([
            "pertanyaan" => $soal,
        ]);
        if($updateSoal == true){
            return back()->with(['sukses_edit' => "Berhasil Mengubah Pertanyaan!"]);
        }else{
            return back()->with(['eror_edit' => "Gagal Menghapus Soal!"]);
        }
    }
    public function edit_opsi(Request $request){
        $id = $request->opsis;
        $Newopsi = $request->opsi;
        $trimNewopsi = str_replace(' ', '', $Newopsi);
        $OldOpsi = $request->oldOpsi;
        $idsoal = $request->soal;
        if (trim($Newopsi) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        //cek apakah opsi yg di edit telah digunakan pada soal yang sama ?
        $getOpsi = opsi_pg::where("id_soal",'=',$idsoal)->get();
        foreach ($getOpsi as $item) {
            if (str_replace(' ', '', $item->opsi) == $trimNewopsi) {
                return back()->with(['error_edit' => "Opsi jawaban sudah tersedia!"]);
            }
        }

        $updateOpsi = DB::table("opsi_pgs")->where("id_opsi",'=',$id)->update([
            "opsi" => $Newopsi
        ]);
        
        if($updateOpsi == true){
            //mengecek apakah opsi yang diubah merupakah jawaban benar, jika iya mengubah data jawaban di jawaban benar
            $cekJawaban = jawaban::where("id_soal",'=',$idsoal)->where("jawaban",'=',$OldOpsi)->first();
            //dd($cekJawaban);
            if($cekJawaban == true){
                $updateJawaban = DB::table("jawabans")->where("id_jawaban",'=',$cekJawaban->id_jawaban)->update([
                    "jawaban" => $Newopsi
                ]);
                if($updateJawaban == true){
                    return back()->with(['sukses_edit' => "Berhasil mengubah opsi!"]);
                }else{
                    return back()->with(['eror_edit' => "Gagal mengubah jawaban benar pada opsi!"]);
                }
            }else{
                return back()->with(['sukses_edit' => "Berhasil mengubah opsi!"]);
            }
        }else{
            return back()->with(['eror_edit' => "Gagal mengubah soal!"]);
        }
    }

    public function edit_jawabanBenar(Request $request){
        $role = session("role");
        $email = session("email");    
        if ($role != "instruktur") {
            return abort(403);
        }
        $idSoal = $request->soalss;
        $jawaban = $request->jawaban;
        $updateJawaban = DB::table("jawabans")->where("id_soal",'=',$idSoal)->update([
            "jawaban" => $jawaban
        ]);

        if($updateJawaban == true){
            // update nilai 
            // get id siswa sama id kuisnya dlu
            $getData = riwayat_pengerjaan::where("id_soal",'=',$idSoal)->get();
            if($getData == true){
                // cek tipe soal ( mix atau engga )
                foreach($getData as $dataRiwayat){
                    // mengubah status soal pada riwayat pengerjaan ( yang tadinya salah jadi benar )
                    $jawabanLama = riwayat_pengerjaan::where("id_kuis",'=',$dataRiwayat->id_kuis)->where("id_siswa",'=',$dataRiwayat->id_siswa)->where("id_soal",'=',$dataRiwayat->id_soal)->first();
                    $updateStatusJawabanSiswa = DB::table("riwayat_pengerjaans")->where("id_soal",'=',$idSoal)->where("id_siswa",'=',$dataRiwayat->id_siswa)->where("jawaban",'=',$jawaban)->update([
                        "status" => 'benar'
                    ]);
                    // mengubah status soal pada riwayat pengerjaan ( yang tadinya benar jadi salah )
                    $updateStatusJawabanSiswa1 = DB::table("riwayat_pengerjaans")->where("id_soal",'=',$idSoal)->where("id_siswa",'=',$dataRiwayat->id_siswa)->where("jawaban",'!=',$jawaban)->update([
                        "status" => 'salah'
                    ]);
                    if($updateStatusJawabanSiswa == true || $updateStatusJawabanSiswa1 == true){
                        $pilgan = false;
                        $isian = false;
                        $cekSoal = soal::where("id_kuis",'=',$dataRiwayat->id_kuis)->get();
                        foreach( $cekSoal as $tipe){
                            if($tipe->type_soal == 'pilgan'){
                                $pilgan = true;
                            }elseif($tipe->type_soal == 'isian' || $tipe->type_soal == 'uraian'){
                                $isian = true;
                            }
                        }
                        $bobotPilgan = 0;
                    // jika dua2 nya true brarti soal di kuis ini campuran
                        if($pilgan == true && $isian == true){
                            $bobotPilgan = 40; // dalam persen
                        }elseif($pilgan == true && $isian == false){
                            $bobotPilgan = 100; // dalam persen
                        }
                        // get jml soal pilgan pada kuis ini ( essay ga perlu karna ga ada pengkoreksian otomatis pada nilai )
                        $totalPilgan = DB::table('soals')
                        ->where('id_kuis', '=', $dataRiwayat->id_kuis)
                        ->where('type_soal', '=', 'pilgan')
                        ->count();
                            
                        $pointNilai = ($bobotPilgan / $totalPilgan);

                        // get data nilai dari tabel nilai
                        $getDataNilai = nilai_kuis::where("id_kuis",'=',$dataRiwayat->id_kuis)->where("id_siswa",'=',$dataRiwayat->id_siswa)->first();
                        if($getDataNilai == true){
                            // cek benar atau salah
                            $getDataNilai2 = riwayat_pengerjaan::where("id_kuis",'=',$dataRiwayat->id_kuis)->where("id_soal",'=',$idSoal)->where("id_siswa",'=',$dataRiwayat->id_siswa)->first();
                            if($getDataNilai2->status != $jawabanLama->status){
                                if($getDataNilai2->status == "salah"){
                                    if(!is_null($getDataNilai->nilai_sementara)){
                                        //dd($getDataNilai->nilai_sementara - $pointNilai);
                                        $updateNilai = DB::table("nilai_kuis")->where("id_nilai_kuis",'=',$getDataNilai->id_nilai_kuis)->update([
                                            "nilai_sementara" => $getDataNilai->nilai_sementara - $pointNilai
                                        ]);
                                        
                                    }else{
                                        $updateNilai = DB::table("nilai_kuis")->where("id_nilai_kuis",'=',$getDataNilai->id_nilai_kuis)->update([
                                            "nilai_fix" => $getDataNilai->nilai_fix - $pointNilai
                                        ]);
                                        
                                    }
                                }else{
                                    if(!is_null($getDataNilai->nilai_sementara)){
                                        $updateNilai = DB::table("nilai_kuis")->where("id_nilai_kuis",'=',$getDataNilai->id_nilai_kuis)->update([
                                            "nilai_sementara" => $getDataNilai->nilai_sementara + $pointNilai
                                        ]);
                                        
                                    }else{
                                        $updateNilai = DB::table("nilai_kuis")->where("id_nilai_kuis",'=',$getDataNilai->id_nilai_kuis)->update([
                                            "nilai_fix" => $getDataNilai->nilai_fix + $pointNilai
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
                    return back()->with(['sukses_edit' => "Berhasil mengubah jawaban!"]);
                }else{
                    return back()->with(['eror_edit' => "Terdapat kesalahan dalam mengubah nilai!"]);
                }
        }else{
            return back()->with(['eror_edit' => "Gagal mengubah jawaban!"]);
        }
    }

    public function viewSoal($nama_mapel, $id_kuis){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }

        $siswa = siswa::where("email",'=',$email)->first();
        // cek apakah kuis udah dikerjain atau belum ( kalau udah brarti review kuis )
        $cekKuis = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$siswa->id_siswa)->first();
        if($cekKuis == true){
            return redirect('/review/kuis')->with(['id_kuis' => $id_kuis]);
        }



        // cek dulu siswa lagi ngerjain kuis yang lain apa engga

        $getLog = log_kuis::where("id_siswa",'=',$siswa->id_siswa)->where('id_kuis','!=',$id_kuis)->first();

        if($getLog == true){
            // ini misal masih lagi ngerjain kuis yang lain
            return back()->with(["error_kuis" => "Sedang mengerjakan kuis lain, selesaikan terlebih dahulu!"]);
        }


        // ini cek misalkan siswa buka kuis yang emg lagi dia kerjain
        $getLog2 = log_kuis::where("id_siswa",'=',$siswa->id_siswa)->where('id_kuis','=',$id_kuis)->first();
        if($getLog2 == true){
            $kuis = kuis::where("id_kuis",'=',$id_kuis)->first();
            //get soal dan opsi dari kuis
            $soal = soal::where("id_kuis",'=',$id_kuis)->get();
            $jmlSoal = $soal->count();
            $opsi = opsi_pg::get();

            // get log yang barusan ditambah buat get time start kuis nya
            $getLog3 = log_kuis::where("id_siswa", '=', $siswa->id_siswa)
            ->where('id_kuis', '=', $id_kuis)
            ->first();
            $currentDate = Carbon::now()->toDateString(); // Format: YYYY-MM-DD
            $startTime = $currentDate . ' ' . $getLog3->start_time; // Gabungkan tanggal dengan waktu
            $getLog3->start_time = Carbon::parse($startTime)->format('Y-m-d\TH:i:s'); 
            //dd($getLog2);
            return view('siswa.kuis.soal')->with(['siswa' => $siswa,'kuis' => $kuis,'soal' => $soal,'opsi' => $opsi,'logKuis' => $getLog3,'jml_soal' => $jmlSoal]);
        }else{

            // misal siswa blm ngerjain kuis
            //inset ke log kuis
            $insertLog = DB::table("log_kuis")->insert([
                "id_kuis" => $id_kuis,
                "start_time" => Carbon::now(),
                "id_siswa" => $siswa->id_siswa
            ]);

            if($insertLog == true){
                //get Kuis
                $kuis = kuis::where("id_kuis",'=',$id_kuis)->first();
                //get soal dan opsi dari kuis
                $soal = soal::where("id_kuis",'=',$id_kuis)->get();
                $jmlSoal = $soal->count();
                $opsi = opsi_pg::get();

                // get log yang barusan ditambah buat get time start kuis nya
                $getLog3 = log_kuis::where("id_siswa", '=', $siswa->id_siswa)
                ->where('id_kuis', '=', $id_kuis)
                ->first();
                $currentDate = Carbon::now()->toDateString(); // Format: YYYY-MM-DD
                $startTime = $currentDate . ' ' . $getLog3->start_time; // Gabungkan tanggal dengan waktu
                $getLog3->start_time = Carbon::parse($startTime)->format('Y-m-d\TH:i:s'); 
                //dd($getLog2);
                return view('siswa.kuis.soal')->with(['siswa' => $siswa,'kuis' => $kuis,'soal' => $soal,'opsi' => $opsi,'logKuis' => $getLog3,'jml_soal' => $jmlSoal]);
            }else{
                return back()->with(["error_kuis" => "Gagal memulai kuis, hubungi admin!"]);
            }
        }
    }

    public function submitKuis($id_kuis, Request $request) {
        $role = session("role");
        $email = session("email");
        $siswa = siswa::where("email", '=', $email)->first();
    
        if ($role != "siswa") {
            return abort(403);
        }
    
        $jawaban = $request->all();
        
        // untuk mendapat data apakah di kuis ini soalnya mix pilgan dan isian atau engga
        $mix = false;
        $pilgan = false;
        $isian = false;
        foreach ($jawaban as $key => $value){
            if (strpos($key, 'jawaban_') === 0) {
                // Ambil ID soal dari nama input (jawaban_{{id_soal}})
                $id_soal = str_replace('jawaban_', '', $key);
                $type_soal = $request->get("type_$id_soal");
                if($type_soal == "pilgan"){
                    $pilgan = true;
                }elseif($type_soal == "isian" || $type_soal = "uraian"){
                    $isian = true;
                }
            }
        }
        // menentukan bobot nilai
        $bobotPilgan = 0;
        $bobotIsian = 0;
        // jika dua2 nya true brarti soal di kuis ini campuran
        if($pilgan == true && $isian == true){
            $mix = true;
            $bobotPilgan = 40; // dalam persen
            $bobotIsian = 60;
        }elseif($pilgan == true && $isian == false){
            $bobotPilgan = 100; // dalam persen
        }elseif($pilgan == false && $isian == true){
            $bobotIsian = 100;
        }

        // get jml soal pilgan pada kuis ini ( essay ga perlu karna ga ada pengkoreksian otomatis pada nilai )
        $totalPilgan = DB::table('soals')
            ->where('id_kuis', '=', $id_kuis)
            ->where('type_soal', '=', 'pilgan')
            ->count();
        // Loop melalui semua jawaban

        $nilai = 0;
        foreach ($jawaban as $key => $value) {
            // Pastikan hanya menangkap input dengan prefix "jawaban_"
            if (strpos($key, 'jawaban_') === 0) {
                // Ambil ID soal dari nama input (jawaban_{{id_soal}})
                $id_soal = str_replace('jawaban_', '', $key); // Mengambil ID soal dari nama input
                $tipe_soal = $request->get("type_$id_soal");
                
                // Cek jika jawaban kosong, set null
                if (empty($value)) {
                    $value = null;
                }
                
                $getJawaban = jawaban::where("jawaban",'=', $value )->where("id_soal",'=',$id_soal)->first();
                // jika jawaban benar
                if($getJawaban == true){
                    // Simpan jawaban ke database ( ini fungsinya buat nyimpen log pengerjaan siswa, jadi kek buat nandain siswa ngerjain soal ini, di kuis ini, edngan jawabn ini)
                    $insertJawaban = DB::table('riwayat_pengerjaans')->insert([
                        'id_kuis' => $id_kuis,
                        'id_soal' => $id_soal, 
                        'jawaban' => $value, 
                        'status' => "benar", 
                        'id_siswa' => $siswa->id_siswa,
                    ]);
                    // kalo true, brarti jawabannya udh jelas dari pilgan ( karena essay ga ada kunci jawaban )
                    if($insertJawaban == true){
                        $pointNilai = ($bobotPilgan / $totalPilgan);
                        $nilai = $nilai + $pointNilai;
                    }
                }else{
                    // get jawaban false tpi tipe soal pilgan, brarti salah
                    if($tipe_soal == "pilgan"){
                        $insertJawaban = DB::table('riwayat_pengerjaans')->insert([
                            'id_kuis' => $id_kuis,
                            'id_soal' => $id_soal, 
                            'jawaban' => $value, 
                            'status' => "salah", 
                            'id_siswa' => $siswa->id_siswa,
                        ]);
                    }else{
                    // get jawaban false tpi tipe soal bukan pilgan, brarti ya emg ga ada kunci jawaban ( karna esay ga ada ), jdi statusnya null
                        $insertJawaban = DB::table('riwayat_pengerjaans')->insert([
                            'id_kuis' => $id_kuis,
                            'id_soal' => $id_soal, 
                            'jawaban' => $value, 
                            'id_siswa' => $siswa->id_siswa,
                        ]);
                    }
                }
            }
        }

        // jika pengkoreksian selesai, jika tipe nya bukan mix , tpi tipe soal nya full pilgan, brarti langsung masuk ke nilai fix
        if($mix == false && $pilgan == true){
            $insertNilai = DB::table("nilai_kuis")->insert([
                "nilai_fix" => $nilai,
                "id_kuis" => $id_kuis,
                'id_siswa' => $siswa->id_siswa,
            ]);
            if($insertNilai == true){
                $hapusLog = DB::table("log_kuis")->where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$siswa->id_siswa)->delete();
                if($hapusLog == true){
                    return redirect('/view/kuis')->with(["status_kuis" => "Kuis telah dikerjakan!"]);
                }else{
                    return redirect('/view/kuis')->with(["status_kuis" => "Terdapat kesalahan saat menghapus log!"]);
                }
            }else{
                return redirect('/view/kuis')->with(["status_kuis" => "Terdapat kesalahan saat memasukkan nilai!"]);
            }
        }elseif(($mix == false && $isian == true) || $mix == true){
            $insertNilai = DB::table("nilai_kuis")->insert([
                "nilai_sementara" => $nilai,
                "id_kuis" => $id_kuis,
                'id_siswa' => $siswa->id_siswa,
            ]);
            if($insertNilai == true){
                $hapusLog = DB::table("log_kuis")->where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$siswa->id_siswa)->delete();
                if($hapusLog == true){
                    return redirect('/view/kuis')->with(["status_kuis" => "Kuis telah dikerjakan!"]);
                }else{
                    return redirect('/view/kuis')->with(["status_kuis" => "Terdapat kesalahan saat menghapus log!"]);
                }
            }else{
                return redirect('/view/kuis')->with(["status_kuis" => "terdapat kesalahan saat memasukkan nilaT"]);
            }
        }
    }
    
    public function reviewKuis($id_kuis){
        $role = session("role");
        $email = session("email");
        $siswa = siswa::where("email", '=', $email)->first();
    
        if ($role != "siswa") {
            return abort(403);
        }

        $kuis = kuis::select("judul_kuis")->where("id_kuis",'=',$id_kuis)->first();
        //dd($id_kuis);
        // get riwayat pengerjaan siswa
        $soal = soal::select("r.id_riwayat", "r.jawaban", "r.status", "r.id_siswa", "s.*",'j.jawaban as jawaban_benar')
        ->from("soals as s")
        ->leftJoin('riwayat_pengerjaans as r', 's.id_soal', '=', 'r.id_soal')
        ->leftJoin('jawabans as j', 's.id_soal', '=', 'j.id_soal')
        ->where("s.id_kuis", '=', $id_kuis)
        ->where("r.id_siswa", '=', $siswa->id_siswa)
        ->get();
    
        //dd($soal);
        $jmlSoal = $soal->count();

        $opsi = opsi_pg::get();

        // menampilkan nilai
        $getNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$siswa->id_siswa)->first();

        return view('siswa.kuis.review_kuis')->with(["soal" => $soal, "siswa" => $siswa,'opsi' => $opsi,'jml_soal' => $jmlSoal,'kuis' => $kuis,'nilai' => $getNilai]);
    }

    public function reviewKuis_siswa($id_kuis, $id_siswa){
        $role = session("role");
        $email = session("email");    
        if($role != "instruktur" && $role != "admin"){
            return abort(403);
        }
        $siswa = siswa::where("id_siswa", '=', $id_siswa)->first();
        $kuis = kuis::where("id_kuis",'=',$id_kuis)->first();

        $soal = soal::select("r.id_riwayat", "r.jawaban", "r.status", "r.id_siswa", "s.*",'j.jawaban as jawaban_benar')
        ->from("soals as s")
        ->leftJoin('riwayat_pengerjaans as r', 's.id_soal', '=', 'r.id_soal')
        ->leftJoin('jawabans as j', 's.id_soal', '=', 'j.id_soal')
        ->where("s.id_kuis", '=', $id_kuis)
        ->where("r.id_siswa", '=', $id_siswa)
        ->get();
        
        $opsi = opsi_pg::get();
        $jmlSoal = $soal->count();

        //dd($soal);
        $getNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$siswa->id_siswa)->first();

        // untuk mengecek tipe kuis temrasuk mix atau bukan
        $soals = soal::where("id_kuis",'=',$id_kuis)->get();
        $pilgan = false;
        $isian = false;
        foreach($soals as $item){
            if($item->type_soal == 'pilgan'){
                $pilgan = true;
            }elseif($item->type_soal == "isian" || $item->type_soal == "uraian"){
                $isian = true;
            }
        }
        if($pilgan && $isian){
            $type_kuis = "mix";
        }else{
            $type_kuis = "non_mix";
        }

        //status koreksi
        $getNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();

        $status_koreksi = false;
        if(!is_null($getNilai->nilai_fix)){
            $status_koreksi = true;
        }
        return view('instruktur.kuis.review_soal')->with(["soal" => $soal,"status_koreksi" => $status_koreksi, "siswa" => $siswa,'opsi' => $opsi,'kuis' => $kuis,'jml_soal' => $jmlSoal,'nilai' => $getNilai,'type' => $type_kuis]);
    }

    public function editStatusJawabanAjax(Request $request){
        $status = $request->status;
        $type_kuis = $request->type_kuis;
        $id_soal = $request->id_soal;
        $id_siswa = $request->id_siswa;
        $id_kuis = $request->id_kuis;
        
        // get data sebelum di update ( untuk mendapatkan status yang lama )
        $getStatus = riwayat_pengerjaan::where("id_kuis",'=',$id_kuis)->where("id_soal",'=',$id_soal)->where("id_siswa",'=',$id_siswa)->first();
        // update status jawaban siswa
        $updateStatus = DB::table('riwayat_pengerjaans')->where('id_kuis','=',$id_kuis)
        ->where("id_siswa",'=',$id_siswa)
        ->where("id_soal",'=',$id_soal)
        ->update([
            "status" => $status
        ]);

        if($updateStatus){
            // get data nilai dlu berdasar id siswa sama id kuis
            $getNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
            if($status == "benar"){
                if(!is_null($getNilai->nilai_sementara)){
                    if($type_kuis == "mix"){
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 60 / $jml_total;

                        $updateNilai = DB::table("nilai_kuis")
                        ->where("id_kuis",'=',$id_kuis)
                        ->where("id_siswa",'=',$id_siswa)
                        ->update([
                            "nilai_sementara" => $getNilai->nilai_sementara + $point
                        ]);
                        if ($updateNilai) {
                            $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                            return response()->json([
                                'success' => true,
                                'message' => 'Berhasil mengoreksi kuis!',
                                'nilai_baru' => $getNilai2->nilai_sementara
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Gagal mengoreksi nilai!',
                            ]);
                        }
                    }else{
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 100 / $jml_total;

                        $updateNilai = DB::table("nilai_kuis")
                        ->where("id_kuis",'=',$id_kuis)
                        ->where("id_siswa",'=',$id_siswa)
                        ->update([
                            "nilai_sementara" => $getNilai->nilai_sementara + $point
                        ]);
                        if ($updateNilai) {
                            $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                            return response()->json([
                                'success' => true,
                                'message' => 'Berhasil mengoreksi kuis!',
                                'nilai_baru' => $getNilai2->nilai_sementara
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Gagal mengoreksi nilai!'
                            ]);
                        }
                    }
                }else{
                    if($type_kuis == "mix"){
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 60 / $jml_total;

                        $updateNilai = DB::table("nilai_kuis")
                        ->where("id_kuis",'=',$id_kuis)
                        ->where("id_siswa",'=',$id_siswa)
                        ->update([
                            "nilai_fix" => $getNilai->nilai_fix + $point
                        ]);
                        if ($updateNilai) {
                            $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                            return response()->json([
                                'success' => true,
                                'message' => 'Berhasil mengoreksi kuis!',
                                'nilai_baru' => $getNilai2->nilai_fix
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Gagal mengoreksi nilai!'
                            ]);
                        }
                    }else{
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 100 / $jml_total;

                        $updateNilai = DB::table("nilai_kuis")
                        ->where("id_kuis",'=',$id_kuis)
                        ->where("id_siswa",'=',$id_siswa)
                        ->update([
                            "nilai_fix" => $getNilai->nilai_fix + $point
                        ]);
                        if ($updateNilai) {
                            $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                            return response()->json([
                                'success' => true,
                                'message' => 'Berhasil mengoreksi kuis!',
                                'nilai_baru' => $getNilai2->nilai_fix
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Gagal mengoreksi nilai!'
                            ]);
                        }
                    }
                }
            }else{
                // get data setelah di update
                $getStatusBaru = riwayat_pengerjaan::where("id_kuis",'=',$id_kuis)->where("id_soal",'=',$id_soal)->where("id_siswa",'=',$id_siswa)->first();
                if(!is_null($getNilai->nilai_sementara)){
                    if($type_kuis == "mix"){
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 60 / $jml_total;

                        if($getNilai->nilai_sementara != 0){
                            if(!is_null($getStatus->status)){
                                $updateNilai = DB::table("nilai_kuis")
                                ->where("id_kuis",'=',$id_kuis)
                                ->where("id_siswa",'=',$id_siswa)
                                ->update([
                                    "nilai_sementara" => $getNilai->nilai_sementara - $point
                                ]);
                                if ($updateNilai) {
                                    $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                                    return response()->json([
                                        'success' => true,
                                        'message' => 'Berhasil mengoreksi kuis!',
                                        'nilai_baru' => $getNilai2->nilai_sementara
                                    ]);
                                } else {
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Gagal mengoreksi nilai!'
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'success' => true,
                                    'message' => 'Berhasil mengoreksi kuis!',
                                    'nilai_baru' => $getNilai->nilai_sementara
                                ]);
                            }
                        }
                    }else{
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 100 / $jml_total;

                        if($getNilai->nilai_sementara != 0){
                            if(!is_null($getStatus->status)){
                                $updateNilai = DB::table("nilai_kuis")
                                ->where("id_kuis",'=',$id_kuis)
                                ->where("id_siswa",'=',$id_siswa)
                                ->update([
                                    "nilai_sementara" => $getNilai->nilai_sementara - $point
                                ]);
                                if ($updateNilai) {
                                    $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                                    return response()->json([
                                        'success' => true,
                                        'message' => 'Berhasil mengoreksi kuis!',
                                        'nilai_baru' => $getNilai2->nilai_sementara
                                    ]);
                                } else {
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Gagal mengoreksi nilai!'
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'success' => true,
                                    'message' => 'Berhasil mengoreksi kuis!',
                                    'nilai_baru' => $getNilai->nilai_sementara
                                ]);
                            }
                        }
                    }
                }else{
                    if($type_kuis == "mix"){
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 60 / $jml_total;

                        if($getNilai->nilai_fix != 0){
                            if(!is_null($getStatus->status)){
                                $updateNilai = DB::table("nilai_kuis")
                                ->where("id_kuis",'=',$id_kuis)
                                ->where("id_siswa",'=',$id_siswa)
                                ->update([
                                    "nilai_fix" => $getNilai->nilai_fix - $point
                                ]);
                                if ($updateNilai) {
                                    $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                                    return response()->json([
                                        'success' => true,
                                        'message' => 'Berhasil mengoreksi kuis!',
                                        'nilai_baru' => $getNilai2->nilai_fix
                                    ]);
                                } else {
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Gagal mengoreksi nilai!'
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'success' => true,
                                    'message' => 'Berhasil mengoreksi kuis!',
                                    'nilai_baru' => $getNilai->nilai_fix
                                ]);
                            }
                        }
                    }else{
                        $totalIsian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'isian')
                        ->count();
                        $totaluraian = DB::table('soals')
                        ->where('id_kuis', '=', $id_kuis)
                        ->where('type_soal', '=', 'uraian')
                        ->count();
                        $jml_total = $totalIsian + $totaluraian;
                        $point = 100 / $jml_total;

                        if($getNilai->nilai_fix != 0){
                            if(!is_null($getStatus->status)){
                                $updateNilai = DB::table("nilai_kuis")
                                ->where("id_kuis",'=',$id_kuis)
                                ->where("id_siswa",'=',$id_siswa)
                                ->update([
                                    "nilai_fix" => $getNilai->nilai_fix - $point
                                ]);
                                if ($updateNilai) {
                                    $getNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
                                    return response()->json([
                                        'success' => true,
                                        'message' => 'Berhasil mengoreksi kuis!',
                                        'nilai_baru' => $getNilai2->nilai_fix
                                    ]);
                                } else {
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Gagal mengoreksi nilai!'
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'success' => true,
                                    'message' => 'Berhasil mengoreksi kuis!',
                                    'nilai_baru' => $getNilai->nilai_fix
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function submitKoreksi($id_kuis, $id_siswa){
        // get data nilai
        $getNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
        //dd($getNilai);
        if(!is_null($getNilai->nilai_sementara)){
            $updateNilai = DB::table("nilai_kuis")
            ->where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)
            ->update([
                "nilai_fix" => $getNilai->nilai_sementara,
                "nilai_sementara" => null,
            ]);
            if($updateNilai == true){
                return back()->with(['sukses_koreksi' => "Berhasil mengoreksi kuis!"]);
            }else{
                return back()->with(['error_koreksi' => "Terdapat kesalahan dalm mengupdate nilai!"]);
            }
        }
    }

    public function cancelKoreksi($id_kuis,$id_siswa){
        // get data nilai
        $getData = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->first();
        // ubah nilai fix ke sementara
        $update = DB::table("nilai_kuis")->where("id_kuis",'=',$id_kuis)->where("id_siswa",'=',$id_siswa)->update([
            "nilai_fix" => null,
            "nilai_sementara" => $getData->nilai_fix
        ]);
        if($update == true){
            return back();
        }else{
            return back()->with(['error_koreksi' => "Terdapat kesalahan dalm membatalkan koreksi!"]);
        }
    }
}
